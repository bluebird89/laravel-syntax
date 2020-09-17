<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    public function form(Request $request)
    {
        // TODO:picture validator failed
        $request->validate([
            'title' => 'bail|required|string|between:2,32',
            'url' => 'sometimes|url|max:200',
            'picture' => 'Nullable|string'
        ], [
            'title.required' => '标题字段不能为空',
            'title.string' => '标题字段仅支持字符串',
            'title.between' => '标题长度必须介于2-32之间',
            'url.url' => 'URL格式不正确，请输入有效的URL',
            'url.max' => 'URL长度不能超过200',
        ]);

        return response('表单验证通过');

//        $request->all();
//        $id = $request->has('id') ? $request->get('id') : 0;
//        $request->except('id');
//        $request->only(['name', 'site', 'domain']);
//        $id = $request->input('id');
//        $name = $request->input('name');
//        $site = $request->input('site', 'Laravel学院');
//        dump($request->input('books.0.author'));
//        dump($request->input('books.1'));
    }

    public function formPage()
    {
        return view('request.form');
    }

    public function fileUpload(Request $request)
    {
        $request->validate( [
            'picture' => 'bail|required|image|mimes:jpg,png,jpeg|max:1024'
        ],[
            'picture.required' => '请选择要上传的图片',
            'picture.image' => '只支持上传图片',
            'picture.mimes' => '只支持上传jpg/png/jpeg格式图片',
            'picture.max' => '上传图片超过最大尺寸限制(1M)'
        ]);

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            if (!$picture->isValid()) {
                abort(400, '无效的上传文件');
            }
            $extension = $picture->getClientOriginalExtension();
            $fileName = $picture->getClientOriginalName();
            $newFileName = md5($fileName.time().mt_rand(1, 10000)).'.'.$extension;
            $savePath = 'images/'.$newFileName;
            $webPath = '/storage/'.$savePath;
            if (Storage::disk('public')->has($savePath)) {
                return response()->json(['path' => $webPath]);
            }

            if ($picture->storePubliclyAs('images', $newFileName, ['disk' => 'public'])) {
                return response()->json(['path' => $webPath]);
            }
            abort(500, '文件上传失败');
        } else {
            abort(400, '请选择要上传的文件');
        }
    }
}
