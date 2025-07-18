<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ["user_id","course_id","license","status"];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function course(){
        return $this->hasMany(Course::class,"id");
    }
}
