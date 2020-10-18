<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Pagination\UrlWindow;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
//        $articles = Article::with('author', 'category')->public()->orderBy('id', 'desc')->seoPaginate($pageSize, $this->listColumns, 'page', $page);
        return view('post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Post/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required', 'max:255'],
            'author' => ['required'],
            'body' => ['required'],
        ], [
            'required' => ':attribute 字段不能为空'
        ])->validateWithBag('storePostInformation');

        $instance  =new Post();
        $instance->title = $request->input('title');
        $instance->url = $request->input('author');
        $instance->content = $request->input('body');
        $instance->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post          $post
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function fetch()
    {
        // 每页显示6篇文章，如果页码太多，当前页码左右只显示2个页码
        $posts = Post::paginate(6)->onEachSide(2)->withPath(url('post'));
        // 处理页码及对应分页URL（页码过多，部分页码省略）
        $window = UrlWindow::make($posts);
        $pages = array_filter([
            $window['first'],
            is_array($window['slider']) ? '...' : null,
            $window['slider'],
            is_array($window['last']) ? '...' : null,
            $window['last'],
        ]);
        return response()->json([
            'paginator' => $posts,
            'elements' => $pages
        ]);
    }
}
