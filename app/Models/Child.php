<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'gender',
        'age',
        'photo',
        'has_disability',
        'disability_details',
        'has_allergy',
        'allergy_details',
        'checkin_time',
        'checkin_date',
        'checkout_time',
        'checkout_date',
        'status',
    ];

    protected $casts = [
        'has_disability' => 'boolean',
        'has_allergy' => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(ParentGuardian::class, 'parent_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'child_id');
    }
}