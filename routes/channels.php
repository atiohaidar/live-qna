<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Event;

Broadcast::channel('event.{eventId}', function ($user, $eventId) {
    return true; // Public channel, anyone can listen
});

Broadcast::channel('event.admin.{eventId}', function ($user, $eventId) {
    return $user !== null; // Only authenticated users (Admins)
});
