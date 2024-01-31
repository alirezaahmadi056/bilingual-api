<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seasons extends Model
{
    use HasFactory;
    protected $fillable = ["title","count_video","course_id"];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function episodes(){
        return $this->hasMany(Episode::class,"season_id");
    }
}
