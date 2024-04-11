<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ["total","payment_code","is_success","course_id","user_id"];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function course(){
        return $this->hasMany(Course::class,"id");
    }
}
