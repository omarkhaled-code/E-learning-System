<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;
    protected $fillable = [
        	'title',
            'price',
            'description',
            'image',
            'video',
            'user_id',
            'category_id',
    ];

    public function belongTo() {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function creator() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function user()
    {
        
        return $this->belongsToMany(User::class, 'payment',  'course_id','student_id');
    }
}
