<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return response()->json(['tasks' => $tasks], 200);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $task = Task::create([
            'user_id' => $user->id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return response()->json(['task' => $task], 201);
    }

    public function show(Task $task)
    {
        return response()->json(['task' => $task], 200);
    }

    public function update(Request $request, Task $task)
    {
        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return response()->json(['task' => $task], 200);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted'], 200);
    }
}
