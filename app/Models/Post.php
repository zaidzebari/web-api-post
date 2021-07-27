<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected  $fillable = ['body'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function topic() {
        return $this->belongsTo(Topic::class);
    }
    public function likes() {
        return $this->morphMany(Like::class, 'likeable');
    }
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

}
