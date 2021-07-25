<?php

namespace App\Models;

use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory, Orderable;

    protected  $fillable = ['title'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function posts() {
        return $this->hasMany(Post::class);
    }
}
