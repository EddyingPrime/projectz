<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardGame extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'long_description',
        'rules',
        'image',
        'min_players',
        'max_players',
        'min_playtime',
        'max_playtime',
        'year_published',
        'designer',
        'publisher',
        'average_rating',
        'difficulty_level',
        'game_type',
        'mechanics',
        'is_expansion',
        'release_date',
        'language_dependency',
        'price',
        'notes',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function mechanics()
    {
        return $this->belongsToMany(Mechanic::class);
    }
}

