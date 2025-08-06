<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'action',
        'description',
        'icon'
    ];

    public static function log($type, $action, $description, $icon = null)
    {
        $defaultIcons = [
            'task' => 'fas fa-tasks',
            'reminder' => 'fas fa-bell',
            'transaction' => 'fas fa-wallet',
            'note' => 'fas fa-sticky-note'
        ];

        $icon = $icon ?? $defaultIcons[$type] ?? 'fas fa-info';

        return self::create([
            'type' => $type,
            'action' => $action,
            'description' => $description,
            'icon' => $icon
        ]);
    }
} 