<?php

use App\Events\TimeAnnounce;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    event(new TimeAnnounce(now()));
})->everyFifteenMinutes();
