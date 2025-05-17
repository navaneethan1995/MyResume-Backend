<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'greeting',
        'name',
        'role',
        'button_text',
        'bio',
        'gpa',
        'degree',
        'institution',
        'duration',
        'background_image',
        'hero_image',
        'about_image',
        'resume',
    ];

    protected $casts = [
        'role' => 'array',
    ];
}
