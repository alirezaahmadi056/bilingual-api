<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ["name","image","description","price","spot_id","percent","hour","teacher_name","score","is_pop"];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function seasons(){
        return $this->hasMany(Seasons::class);
    }

    public function user(){
        return $this->belongsTo(Cart::class);
    }

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }
}
