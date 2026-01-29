<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Task::query();
        if($request->filled('search')){
            $query->where('title','like',"%{$request->search}%");
        }
        $tasks = $query->latest()->paginate(10)->withQueryString();
        return view('tasks.index',compact('tasks'))
                                ->with('success','Task created successfully!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);
        Task::create($request->all());
        // $task = new Task;
        // $task->title = $request->title;
        // $task->description = $request->description;
        // $task->status = $request->status;
        // $task->save();
        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // $task->title = $request->title;
        // $task->description = $request->description;
        // $task->status = $request->status;
        // $task->save();
        $task->update($request->all());
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/tasks');
    }
}
