<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
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

        Reminder::create([
            'title' => $request->title,
            'description' => $request->description,
            'reminder_date' => $request->reminder_date,
            'is_completed' => false,
        ]);

        return redirect()->route('reminders.index')->with('success', 'Pengingat berhasil ditambahkan!');
    }
}