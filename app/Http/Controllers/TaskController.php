<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');

        $tasks = Task::query()
            ->when($filter === 'today', fn($q) => $q->today())
            ->when($filter === 'week', fn($q) => $q->thisWeek())
            ->when($filter === 'completed', fn($q) => $q->completed())
            ->latest()
            ->get();

        return view('task', compact('tasks', 'filter'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'nullable|in:low,medium,high',
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created!');
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'nullable|in:low,medium,high',
            'completed' => 'sometimes|boolean',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    public function toggle(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        $task->update(['completed' => $request->completed]);
        return response()->json(['success' => true]);
    }
}

