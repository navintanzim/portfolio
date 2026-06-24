<?php

use Illuminate\Support\Facades\Route;

// Keep Laravel from depending on Blade or the database.
// If these routes are ever hit, send them to the static site.
Route::redirect('/', '/index.html');

Route::get('/projects/{slug}', function (string $slug) {
    return redirect("/projects/{$slug}.html");
});
