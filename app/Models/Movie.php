<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'year',
        'rating',
        'review',
        'watched',
    ];

    protected $casts = [
        'year' => 'integer',
        'rating' => 'decimal:1',
        'review' => 'string',
        'watched' => 'boolean',
    ];
}
