<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'code', 'start_date', 'is_active'];

    protected $casts = [
        'start_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
