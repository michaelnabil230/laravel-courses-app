<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('project:init', function () {
    Artisan::call('migrate:refresh');
    $this->info(Artisan::output());
    Artisan::call('db:seed');
    $this->info(Artisan::output());
    Artisan::call('storage:link');
    $this->info(Artisan::output());
    Artisan::call('debugbar:clear');
    $this->info(Artisan::output());
    Artisan::call('optimize:clear');
    $this->info(Artisan::output());
})->describe('Running commands');

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
