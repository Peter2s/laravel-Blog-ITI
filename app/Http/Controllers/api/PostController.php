<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(){
        $posts = Post::withTrashed()->with('user')->paginate(5);
        return  PostResource::collection($posts);
    }
    public function show($post_id)
    {
        $post = Post::with('user')->where('id', $post_id)->first();
        return new PostResource($post);
    }
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->user_id;
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('images', 'public');
        }
        $post->save();
        return new PostResource($post);
    }
    public function update($post_id,UpdatePostRequest $request)
    {
        $post = Post::where('id', $post_id)->first();
        if($post){
            $post->title = $request->title;
            $post->description = $request->description;
            if($request->hasFile('image')){
                $post->image = $request->file('image')->store('images', 'public');
                $old_image = $post->image;
                Storage::delete($old_image);
            }
            $post->save();

        }
        return new PostResource($post);
    }
    public function destroy($post_id)
    {
        $post = Post::find($post_id);
        $post->delete();
        return new PostResource($post);
    }
}
