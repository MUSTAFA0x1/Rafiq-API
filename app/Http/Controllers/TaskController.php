<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;


class TaskController extends Controller
{

    //================================================================================================

    public function index()
    {
        $tasks = auth()->user()->tasks;

        return response()->json(['tasks' => $tasks], 200);
    }
    //================================================================================================

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:high,medium,low',
            'status' => 'required|in:not_started,completed,in_progress,canceled',
            'deadline' => 'nullable|date',
        ]);

        $task = new Task($validated);
        $task->user_id = auth()->id();
        $task->save();

        return response()->json([
            'message' => 'Task created successfully',
            'task' => $task,
        ], 201);
    }
    //================================================================================================

    public function update(Request $request, $id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);

        $task->update($request->only('title','description','priority','status','deadline'));

        return response()->json(['message' => 'Task updated successfully', 'task' => $task], 200);
    }
    //================================================================================================

    public function show($id)
    {
        $task = auth()->user()->tasks()->where('task_id', $id)->first();

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json(['Task' => $task], 200);
    }
    //================================================================================================

    // Delete a task
    public function destroy($id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
