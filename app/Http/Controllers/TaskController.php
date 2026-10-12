<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Services\TaskService;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        // $tasks = Task::all();


        if ($request->user()->role === 'admin') {
            $tasks = \App\Models\Task::all();
        } else {
            $tasks = $request->user()->tasks()->get();
        }


        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request, TaskService $taskService)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        // Task::create($validated);
        // $request->user()->tasks()->create($validated);
        $taskService->createTask($request->user(), $validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task created successfully');
    }

    public function edit(Task $task)
    {
        Gate::authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        Gate::authorize('update', $task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task->update($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated successfully');
    }


    public function destroy(Task $task)
    {
        Gate::authorize('delete', $task);

        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }


    public function apiIndex(Request $request)
    {
        if ($request->user()->role === 'admin') {
            return response()->json(\App\Models\Task::all());
        }

        return response()->json($request->user()->tasks()->get());
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task = $request->user()->tasks()->create($validated);

        return response()->json($task, 201);
    }
}
