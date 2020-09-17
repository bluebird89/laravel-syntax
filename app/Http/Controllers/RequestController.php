<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function form(Request $request, $id)
    {
        dd($id);
        $request->all();
        $id = $request->has('id') ? $request->get('id') : 0;
        $request->except('id');
        $request->only(['name', 'site', 'domain']);
        $id = $request->input('id');
        $name = $request->input('name');
        $site = $request->input('site', 'Laravel学院');
        dump($request->input('books.0.author'));
        dump($request->input('books.1'));
    }
}
