<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('inventory:summary', function () {
    $this->info('Retail inventory system is installed.');
});
