<?php
/**
 * Developed by Eugene Ogongo on 7/20/19 10:45 AM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/20/19 10:42 AM
 * Copyright (c) 2019 . All rights reserved
 */

use Illuminate\Foundation\Inspiring;

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

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');
