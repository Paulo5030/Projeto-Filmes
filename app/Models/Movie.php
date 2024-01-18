<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'description',
        'image',
        'trailer',
        'category',
        'length',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function review()
    {
        return $this->hasMany(Review::class, 'movies_id');
    }
}
