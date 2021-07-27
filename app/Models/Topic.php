<?php

namespace App\Models;

use App\Traits\Orderable;
use Carbon\Carbon;
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
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}
