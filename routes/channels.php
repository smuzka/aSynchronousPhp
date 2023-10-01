<?php

use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('getApiChannel', function () {
    return true;
});

Broadcast::channel('getDBChannel', function () {
    return true;
});
