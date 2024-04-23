<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\User;
use Faker\Provider\en_GB\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller 
{
 
    public function register(Request $request){
        
        
        
        $incomingFields = $request->validate([
            'name'=> "required",
            'email' => ['required', 'email'],
            'password' => ['min:8', 'required'],
            'gender'=> "required",
            'access' => "required",
        ]);
        if($request->has('image')) {
            $path = $request->file('image')->store('images','public');
            $incomingFields['image'] = $path;
        }

        if($request->has('profession')) {
            
            $incomingFields['profession'] = $request->profession;
        }

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        
        return User::create($incomingFields);
        
    }
    public function login(Request $request){

        

        $incomingFields = $request->validate(([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ]));


        

        if(auth()->attempt($incomingFields)) {
            
            $token = auth()->user()->createToken('01omar')->plainTextToken;
            return response()->json([
                'token' => $token
            ],200);
        }
        return response()->json([
            'error' => 'unauthorized'
        ],401);
    }
    

    public function show(){
        $users = User::all();

        return response()->json([
            'users' => $users,
        ],201);
    }

    public function user(){
        return Auth::user();
        
    }

    public function latestTeacher (){
        $latestTeacher = User::where("access", 'teacher')->get();
        return response()->json([
            'latestTeacher' => $latestTeacher,
        ]);
    }
    public function allTeacher(){
        $teachers = User::where("access", "teacher")->get();
        return response()->json([
            'teachers' => $teachers,
        ]);
    }
    // public function subscription(Courses $courses)
    public function subscription(Request $request)
    {
        
        $userID = $request->student_id;
        $courseID = $request->id;
        $course = Courses::where('id', $courseID)->first();
        

        $course->user()->attach($userID);
         return response()->json([
            'msg' => "success!",
            'id' => $courseID,
        ]);

    }

    public function update(Request $request){
        $id = $request->id;
        $user = User::where("id", $id)->first();

        $incomingFields = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'gender' => 'required',
            'access' => 'required',
            'profession' => 'required',
        ]);

        if($request->has('facebook')) {
            $incomingFields['facebook'] = $request->facebook;
        }
        if($request->has('instagram')) {
            $incomingFields['instagram'] = $request->instagram;
        }
        if($request->has('twitter')) {
            $incomingFields['twitter'] = $request->twitter;
        }

        if($incomingFields['access'] == 'admin' && $user->access != "admin") {
            $incomingFields['access'] = 'student'; 
        }else if($user->access == 'admin'){
            $incomingFields['access'] = 'admin';
        }
        if($request->image != null){
            $path = $request->file('image')->store('images','public');
            $incomingFields['image'] = $path;
            
        }
        
        $user->update($incomingFields);

        return $user;
    }


    public function get_access($id){

        $user = User::where("id", $id)->first();

        return response()->json([
            'access' => $user->access,
        ]);
    }

    public function delete($id){
        return User::where("id", $id)->delete();
    }


}
