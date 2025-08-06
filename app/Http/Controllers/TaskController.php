<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Activity;
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

        $task = Task::create($validated);

        // Log activity
        Activity::log('task', 'created', "Task '{$task->title}' telah dibuat", 'fas fa-tasks');

        return redirect()->route('tasks.index')->with('success', 'Task created!');
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'nullable|in:low,medium,high',
            'completed' => 'sometimes|boolean',
        ]);

        $task->update($validated);

        // Log activity
        $action = isset($validated['completed']) ? 'completed' : 'updated';
        $description = isset($validated['completed']) 
            ? "Task '{$task->title}' telah " . ($validated['completed'] ? 'diselesaikan' : 'dibuka kembali')
            : "Task '{$task->title}' telah diperbarui";
        
        Activity::log('task', $action, $description, 'fas fa-tasks');

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function edit(Task $task)
    {
        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $taskTitle = $task->title;
        $task->delete();
        
        // Log activity
        Activity::log('task', 'deleted', "Task '{$taskTitle}' telah dihapus", 'fas fa-tasks');
        
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    public function toggle(Request $request, Task $task)
    {
        $task->update(['completed' => $request->completed]);
        
        // Log activity
        $status = $request->completed ? 'diselesaikan' : 'dibuka kembali';
        Activity::log('task', 'toggled', "Task '{$task->title}' telah {$status}", 'fas fa-tasks');
        
        return response()->json(['success' => true]);
    }
}

