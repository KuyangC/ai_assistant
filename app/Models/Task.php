<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Task.php
class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'priority',
        'completed'
    ];

    public function scopeToday($query)
    {
        return $query->whereDate('due_date', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('due_date', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    public function scopeCompleted($query)
    {
        return $query->where('completed', true);
    }
}