<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //create post data

    public function Store(Request $request){


    $post =new Post;

    $img = $request->file('image');
    $ext = $img->getClientOriginalExtension();
    $image = time().'.'.$ext;
    $save = $img->move(public_path('images'),$image);

    $post->name = $request->name;
    $post->title = $request->title;
    $post->des = $request->des;
    $post->image = $image;

    $post->save();

    return response()->json([
        'status'=>true,
        'message'=>'Post created successfully',
        'post'=>$post,
    ],201);

    }

    //show all post

    public function show(){
        $post =  Post::get();

        return response()->json([
            'status'=>true,
            'message'=>'all posted here',
            'post'=>$post,
        ],201);

    }

//delete post
    public function destry($id){
        $post = Post::where('id',$id)->first();
        $post->delete();

        return response()->json([
            'status'=>true,
            'message'=>'post delete successfully',
            'post'=>$post,
        ],201);

    }

    //show single post

    public function single($id){
        $post = Post::where('id',$id)->first();


        return response()->json([
            'status'=>true,
            'message'=>'single post here',
            'post'=>$post,
        ],201);

    }
    public function editpost(Request $request , $id){


        $img = $request['image'];
        $ext = $img->getClientOriginalExtension();
        $image = time().'.'.$ext;
        $save = $img->move(public_path('images'),$image);

        $post = Post::where('id',$id)->first();


        $post->name = $request->input('name');
        $post->title = $request->input('title');
        $post->des = $request->input('des');
        $post->image = $image;

        $post->save();

        return response()->json([
            'status'=>true,
            'message'=>'Post updated Successfully',
            'post'=>$post,
        ],202);

    }
}
