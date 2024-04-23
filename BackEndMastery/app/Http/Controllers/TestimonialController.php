<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function check_testimonial($id){ 
        $user = User::where("id", $id)->first();
        $user->testimonial;
        if($user->course && !$user->testimonial)
        
            return $user;
            // return $user->course->count();
        else 
            return "Null";
    }

    public function create(Request $request) {
        $incomingFields = $request->validate([
            'content' => 'required',
            'user_id' => 'required',
    ]);
        $incomingFields['content']= strip_tags($incomingFields['content']);
        return Testimonial::create($incomingFields);
    }

    public function index(){
        $testimonials =  Testimonial::all();
        $users=[];
        $count =  $testimonials->count();
        for($i = 0; $i < $count; $i ++) {
            $users[$i] = $testimonials[$i]->user;
        }
        return response()->json([
            'testimonials'=> $testimonials,
        ]);
    }   

}
