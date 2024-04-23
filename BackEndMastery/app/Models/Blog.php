<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title','content', 'image', 'user_id', "category_id"];

    public function belongTo() {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function creator() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
