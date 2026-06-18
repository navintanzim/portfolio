<?php

use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $skills = Skill::query()
        ->orderBy('sort_order')
        ->orderBy('name')
        ->get();

    $experiences = Experience::query()
        ->orderBy('sort_order')
        ->orderByDesc('start_date')
        ->get();

    $educations = Education::query()
        ->orderBy('sort_order')
        ->orderByDesc('degree_obtained')
        ->get();

    return view('welcome', compact('skills', 'educations', 'experiences'));
});
