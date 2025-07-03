<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
//use Illuminate\Foundation\Scheduling\Schedule;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

//return function (Schedule $schedule) {
//    $schedule->command('command:email:daily')->everyMinute();

//};
Schedule::command('email:daily')->everyMinute();