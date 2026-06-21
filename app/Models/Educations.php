<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Educations extends Model
{
    protected $fillable = [
        'institution',
        'degree_type',
        'degree_obtained',
        'subject',
        'cgpa',
        'sort_order',
    ];
}
