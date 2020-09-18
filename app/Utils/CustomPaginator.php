<?php


namespace App\Utils;

use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator as BasePaginator;

/**
 * Class CustomPaginator
 * ?page=100 => page/100
 * @package App\Utils
 */
class CustomPaginator extends BasePaginator
{
    /**
     * 重写页面 URL 实现代码，去掉分页中的问号，实现伪静态链接
     * @param int $page
     * @return string
     */
    public function url($page)
    {
        if ($page <= 0) {
            $page = 1;
        }

        // 移除路径尾部的/
        $path = rtrim($this->path, '/');

        // 如果路径中包含分页信息则正则替换页码，否则将页码信息追加到路径末尾
        if (preg_match('/\/page\/\d+/', $path)) {
            $path = preg_replace('/\/page\/\d+/', '/page/' . $page, $path);
        } else {
            $path .= '/page/' . $page;
        }
        $this->path = $path;

        if ($this->query) {
            $url = $this->path . (Str::contains($this->path, '?') ? '&' : '?')
                . http_build_query($this->query, '', '&')
                . $this->buildFragment();
        } elseif ($this->fragment) {
            $url = $this->path . $this->buildFragment();
        } else {
            $url = $this->path;
        }

        return $url;
    }

    /**
     * 重写当前页设置方法
     *
     * @param  int  $currentPage
     * @param  string  $pageName
     * @return int
     */
    protected function setCurrentPage($currentPage, $pageName)
    {
        if (!$currentPage && preg_match('/\/page\/(\d+)/', $this->path, $matches)) {
            $currentPage = $matches[1];
        }

        return $this->isValidPageNumber($currentPage) ? (int) $currentPage : 1;
    }

    /**
     * 将新增的分页方法注册到查询构建器中，以便在模型实例上使用
     * 注册方式：
     * 在 AppServiceProvider 的 boot 方法中注册：AcademyPaginator::rejectIntoBuilder();
     * 使用方式：
     * 将之前代码中在模型实例上调用 paginate 方法改为调用 seoPaginate 方法即可：
     * Article::where('status', 1)->seoPaginate(15, ['*'], 'page', page);
     */
    public static function injectIntoBuilder()
    {
        Builder::macro('seoPaginate', function ($perPage, $columns, $pageName, $page) {
            $perPage = $perPage ?: $this->model->getPerPage();

            $items = ($total = $this->toBase()->getCountForPagination())
                ? $this->forPage($page, $perPage)->get($columns)
                : $this->model->newCollection();

            $options = [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ];

            return Container::getInstance()->makeWith(AcademyPaginator::class, compact(
                'items', 'total', 'perPage', 'page', 'options'
            ));
        });
    }
}
