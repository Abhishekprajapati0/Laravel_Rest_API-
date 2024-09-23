<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Post::get();

        return response()->json([
            'status'=>true,
            'message'=>'all data here',
            'data'=>$data,
        ],201);
    }


    public function store(Request $request)
    {
        $validate =
        Validator::make($request->all(),[
            'name'=>'required',
            'title'=>'required',
            'image'=>'nullable',
            'des'=>'required',
        ]);
        if($validate->failed()){
            return response()->json([
                'status'=>false,
                'message'=>'Vallidation Error',
                'error'=>$validate->error()->all(),
            ],401);
        }else{
         $post = new Post;
         $img = $request->file('image');
         $ext = $img->getClientOriginalExtension();
          $imageName = time(). '.' . $ext;
           $imgsave = move(public_path('/images'),$imageName);

           $post->name = $request->name;
           $post->image =$imageName;
           $post->des = $request->des;
           $post->title = $request->title;

           $post->save();

           return response()->json(['status'=>true,'message'=>'Post Created Successfully','post'=>$post],201);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $post = Post::where('id',$id)->first();

        return respons()->json([
            'status'>true,
            'message'=>'Sfaicepic User here',
            'data'=>$post,
        ],20);
    }


    public function update(Request $request, string $id)
    {
        //
        $post = Post::where('id',$id)->first();

        $validate =
        Validator::make($request->all(),[
            'name'=>'required',
            'title'=>'required',
            'image'=>'nullable',
            'des'=>'required',
        ]);
        if($validate->failed()){
            return response()->json([
                'status'=>false,
                'message'=>'Vallidation Error',
                'error'=>$validate->error()->all(),
            ],401);
        }else{

         $img = $request->file('image');
         $ext = $img->getClientOriginalExtension();
          $imageName = time(). '.' . $ext;
           $imgsave = move(public_path('/images'),$imageName);

           $post->name = $request->name;
           $post->image =$imageName;
           $post->des = $request->des;
           $post->title = $request->title;

           $post->save();

           return response()->json(['status'=>true,'message'=>'Post Updated Successfully','post'=>$post],201);
        }



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $post = Post::where('id',$id)->get()->delete();
        return response()->json(['message'=>'Post Deleted SuccessFully'],201);
    }
}
