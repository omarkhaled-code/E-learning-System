<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class CategoryController extends Controller
{
    public function create(Request $request){
            
        
        $incomingFields = $request->validate([
            'name'=>'required',
            'image' => ['image','required']
        ]);
        $incomingFields['name'] = strip_tags($incomingFields['name']);
        if($request->has('description')) {
            $incomingFields['description'] =strip_tags($request['description']);
        }
        
        // create image

        $path = $request->file('image')->store('images','public');

        
        $incomingFields['image'] = $path;

        Category::create($incomingFields);
     
        
        return response()->json([
            'msg' => "created successfully",
        ]);
    }
    public function index(){
        $allCategory = Category::all();
      
        return response()->json([
            'allCategory' => $allCategory,
        ]);
    }



    public function lastCategory(){
        $LastCategory = Category::latest()->take(8)->get();
        if($LastCategory){
         return response()->json([
            'LastCategory' => $LastCategory,
        ]);
        }
        return nullValue();
    }

    public function show(Request $request) {
        $id = $request->id;
        $category = Category::where("id",$id)->first();
        $category->courseCreated;
        $category->blogsCreated;
        if($category) {
            return response()->json([
                'category' => $category,
            ]);
        };
            return response()->json([
                'msg' => "undefined",
            ],404);
        
        

    }

    public function delete(Request $request){
        $id = $request->id;
        $category = Category::where("id",$id)->first();

        $category->delete();

        return response()->json([
            'msg' => "deleted successfully",
        ]);
    }

    public function edit(Request $request){
        
        $id = $request->id;
        $category = Category::where("id",$id)->get();
        return response()->json([
            'category' => $category,
        ]);
    }

    public function update(Request $request){ 
        $id = $request->id;
        
        $category = Category::where("id",$id)->first();
         $incomingFields = $request->validate([
            'name'=>'required',
        ]);

        if ($request->image != null) {
            $path = $request->file('image')->store('images','public');
            $incomingFields['image'] = $path;
        }
        if($request->has('description')) {
            $incomingFields['description'] =strip_tags($request['description']);
        }

        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $category->update($incomingFields);
        return $category;
        return response()->json([
            // 'newcategory' => "updated successfully",
            'category' => $category,
            "msg" => "hi"
            
        ]);
    }

    public function getLinks() {
        $category = Category::all('id','name');
        return response()->json([
            'category' => $category
        ]);
    }

}
