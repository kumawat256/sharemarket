<?php

use Illuminate\Support\Facades\Broadcast;
use App\Events\DataReceived;
// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

    Broadcast::channel('dhandata', function () {
        return event(new DataReceived('Test Message'));
    });
