<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CoursesController extends Controller
{
    public function index(){
        $courses = Courses::all();
        return response()->json([
            'courses'=> $courses,
        ]);
    }
    public function latestCourses() {
        $courses = Courses::latest()->take(8)->get();
        
        return response()->json([
            'courses'=> $courses,
        ]);
    }

    public function show($id, $user_id){

   
        
        $course = Courses::where('id',$id)->first();
        
        $course->creator;
        $status=false;

        
        if($user_id == 0) {
            return response()->json([
                'course'=> $course,
                'status' => $status
            ]);         
        }
        
        
        $count = $course->user->count();

        if($course && $count > 0) {
            
            for($i = 0 ; $i < $count; $i++) {
                    
                    $studentID = $course->user[$i]->pivot->student_id;
                    
                    if($studentID == $user_id) {
                        return response()->json([
                            'course'=> $course,
                            'status' => true
                        ]);     
                        } 
                        
                    }
            
            
        }

        $creatorID = $course->creator->id;
            if( $creatorID == $user_id){
                $status= true;
            }
        return response()->json([
            'course'=> $course,
            'status' => $status
        ]);     
    }
 



    public function create(Request $request) {

        
        $incomingFields = $request->validate([
            'title' => ['required'],
            'price' => ['required'],
            'description' => ['required', 'max:500'],
            'image' => ['required', 'image'],
            'video' => ['required'],
            'user_id' => ['required'],
            'category_id' => ['required'],
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['price'] = strip_tags($incomingFields['price']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['user_id'] = (int)$incomingFields['user_id'];
        $incomingFields['category_id'] = (int)$incomingFields['category_id'];
        $imgPath = $request->file('image')->store('images','public');
        $incomingFields['image'] = $imgPath;
        $video = $request->file('video');
        $videoPath = Storage::putFile('videos',$video);
        // return var_dump($incomingFields);
        $incomingFields['video'] = $videoPath;
        Courses::create($incomingFields);

        return response()->json([
            'course' => $incomingFields,
            'msg' => 'Created Successfully'
        ]);
    

    }
    public function edit(Request $request) {
        $id = $request->id;
        $course = Courses::where("id",$id)->first();
        $course->belongTo; 
        
        // $course['category'] = $category;
        
        return response()->json([
            'course' => $course,
        ]);
    }

    public function update(Request $request) {


        $id = $request->id;
        
        
        $course = Courses::where("id",$id)->first();

        $incomingFields = $request->validate([
            'title' => 'required',
            'price' => 'required',
            'description' => ['required', 'max:500'],
            'category_id'=> 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['price'] = strip_tags($incomingFields['price']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['category_id'] = (int)$incomingFields['category_id'];
        


        if ($request->image != null) {
            $path = $request->file('image')->store('images','public');
            $incomingFields['image'] = $path;
        }

        

        
        
        // return var_dump($incomingFields);
        
        $course->update($incomingFields);

        return response()->json([
            'course'=> $course,
            'msg' => 'Updated Successfully'
        ]);

    }


    public function delete(Request $request){
        $id = $request->id;
        $course = Courses::where("id", $id)->first();
        $course->delete();
        
        return response()->json([
            'msg' => "deleted successfully",
        ]);
    }


    public function streamVideo($id) {

        $video = Courses::where('id', $id)->get()->first();

        $video = Courses::findOrFail($id);
        


       $filContents = Storage::get($video->video);
       $response = Response::make($filContents, 200);
       $response->header('Content-Type', 'video/mp4');
       return $response;

    }

    public function my_courses($id) {
        $user = User::where("id", $id)->first();
        $user->course;
        $user->courseCreated;
        return response()->json([
            'courses' => $user->course,
            'course_created' => $user->courseCreated,
        ]);
    }

}
