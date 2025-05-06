<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'nama',
        'slug',
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
