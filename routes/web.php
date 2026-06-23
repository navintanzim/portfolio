<?php

use App\Models\Educations;
use App\Models\Experience;
use App\Models\Project;
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

    $educations = Educations::query()
        ->orderBy('sort_order')
        ->orderByDesc('degree_obtained')
        ->get();

    $projects = Project::query()
        ->where('featured', true)
        ->with(['highlights', 'technologies', 'images'])
        ->orderBy('sort_order')
        ->orderByDesc('completed_at')
        ->get();

    return view('welcome', compact('skills', 'educations', 'experiences', 'projects'));
});

Route::get('/projects/{project:slug}', function (Project $project) {
    $project->load(['highlights', 'technologies', 'images']);

    return view('projects.show', compact('project'));
})->name('projects.show');
