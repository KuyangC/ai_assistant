<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::all();
        return view('reminder', compact('reminders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'reminder_date' => 'required|date',
        ]);

        $reminder = Reminder::create([
            'title' => $request->title,
            'description' => $request->description,
            'reminder_date' => $request->reminder_date,
            'is_completed' => false,
        ]);

        // Log activity
        Activity::log('reminder', 'created', "Pengingat '{$reminder->title}' telah dibuat", 'fas fa-bell');

        return redirect()->route('reminders.index')->with('success', 'Pengingat berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'reminder_date' => 'required|date',
            'is_completed' => 'boolean',
        ]);

        $reminder = Reminder::findOrFail($id);
        $reminder->update([
            'title' => $request->title,
            'description' => $request->description,
            'reminder_date' => $request->reminder_date,
            'is_completed' => $request->is_completed ?? false,
        ]);

        // Log activity
        $action = isset($request->is_completed) ? 'completed' : 'updated';
        $description = isset($request->is_completed) 
            ? "Pengingat '{$reminder->title}' telah " . ($request->is_completed ? 'diselesaikan' : 'dibuka kembali')
            : "Pengingat '{$reminder->title}' telah diperbarui";
        
        Activity::log('reminder', $action, $description, 'fas fa-bell');

        return redirect()->route('reminders.index')->with('success', 'Pengingat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $reminder = Reminder::findOrFail($id);
        $reminderTitle = $reminder->title;
        $reminder->delete();
        
        // Log activity
        Activity::log('reminder', 'deleted', "Pengingat '{$reminderTitle}' telah dihapus", 'fas fa-bell');
        
        return redirect()->route('reminders.index')->with('success', 'Pengingat berhasil dihapus!');
    }

    public function toggle($id)
    {
        $reminder = Reminder::findOrFail($id);
        $reminder->update(['is_completed' => !$reminder->is_completed]);
        
        // Log activity
        $status = $reminder->is_completed ? 'diselesaikan' : 'dibuka kembali';
        Activity::log('reminder', 'toggled', "Pengingat '{$reminder->title}' telah {$status}", 'fas fa-bell');
        
        return response()->json(['success' => true]);
    }
}