<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'rating',
        'review',
        'users_id',
        'movies_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function movie() {
        return $this->belongsTo(Movie::class);
    }
}