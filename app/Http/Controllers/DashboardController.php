<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Reminder;
use App\Models\Transaction;
use App\Models\Note;
use App\Models\Activity;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'taskCount' => Task::count(),
            'reminderCount' => Reminder::count(),
            'transactionCount' => Transaction::count(),
            'noteCount' => Note::count(),
            'recentActivities' => Activity::latest()->take(5)->get(),
        ];

        return view('app', $data);
    }
} 