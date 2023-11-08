<?php

use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('asyncChannel', function () {
    return true;
});

Broadcast::channel('syncChannel', function () {
    return true;
});

Broadcast::channel('promisesChannel', function () {
    return true;
});
