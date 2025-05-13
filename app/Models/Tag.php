<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';

    protected $fillable = [
        'nama',
        'slug',
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
