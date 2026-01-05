<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'content', 'status', 'is_current', 'is_answered', 'votes_count'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
