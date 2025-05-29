<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Kyuib-App' => 'V1'];
});

require __DIR__.'/auth.php';
