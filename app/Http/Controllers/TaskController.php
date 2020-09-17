<?php

namespace App\Http\Controllers;

use App\Http\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('task.index')
            ->with('tasks', Task::all());
    }

    public function store(Request $request)
    {
        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->save();
        return redirect('task');   // 重定向到 GET task 路由
    }
}
