<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function create(Request $request){
        $incomingFields = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => ['required', 'image'],
            'user_id' => 'required',
            'category_id' => 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['content'] = strip_tags($incomingFields['content']);
        $imgPath = $request->file('image')->store('images','public');
        $incomingFields['image'] = $imgPath;

        Blog::create($incomingFields);
        return response()->json([
            'msg'=> 'your blog created successfully'
        ]);
    }
    public function index(){
        $blogs = Blog::all();
        return response()->json([
            'blogs' => $blogs,
        ]);
    }

    public function lastBlogs(){
        
        
        $blogs = Blog::latest()->take(4)->get();
        return response()->json([
            'blogs' => $blogs,
        ]);
    }

    public function show($id){
        $blog = Blog::where("id", $id)->first();
        $blog->creator;
        return response()->json([
            'blog'=> $blog
        ]);
    }
    public function delete($id){
        return Blog::where("id", $id)->delete();
    }
    public function edit($id) {
        $blog = Blog::where("id", $id)->first();
        return response()->json([
            'blog'=> $blog
        ]);
    }
    public function update(Request $request){
        $id = $request->blog_id;
        $blog = Blog::where("id", $id)->first();
        $incomingFields = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required',
            
        ]);
        
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['content'] = strip_tags($incomingFields['content']);

        if($request->image != null) {
            $imgPath = $request->file('image')->store('images','public');
            $incomingFields['image'] = $imgPath;
        }

        $blog->update($incomingFields);
        return response()->json([
            'msg'=> 'your blog updated successfully'
        ]);
    }
    public function my_blogs($id){
        $user = User::where("id", $id)->first();
        $blogs = $user->blogs;
        
        return response()->json([
            'blogs' => $blogs,
        ]);
    }


}
