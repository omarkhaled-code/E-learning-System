<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image'];

    public function courseCreated(){
        return $this->hasMany(Courses::class,"category_id");        
    }

    public function blogsCreated(){
        return $this->hasMany(Blog::class,"category_id");        
    }

}
