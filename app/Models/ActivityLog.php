<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'loggable_type', 'loggable_id',
        'action', 'description', 'performed_by',
    ];
}