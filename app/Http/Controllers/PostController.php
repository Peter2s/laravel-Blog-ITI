<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::withTrashed()->paginate(5);

        return view('posts.index',['posts'=>$posts]);
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create',['users'=>$users]);
    }
    public function edit($post)
    {
       return view('posts.edit',['post'=>$post]);
    }
    public function show($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        return view('posts.show',['post'=>$post]);
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
        return to_route('posts.index');
    }
    public function update($post_id,UpdatePostRequest $request)
    {
        $post = Post::where('id', $post_id)->first();
        if($post){
            $post->title = $request->title;
            $post->description = $request->description;
            $post->save();
        }
        return to_route('posts.show',['post'=>$post]);
    }
    public function destroy($post_id)
    {
        $post = Post::find($post_id);
        $post->delete();
        return to_route('posts.index');
    }
    public function restore($post_id)
    {
        $post = Post::withTrashed()->findOrFail($post_id);
        $post->restore();
        return to_route('posts.index');
    }
    public function addComment($post_id){
        $post = Post::find($post_id);
        if($post){
            $post->comments()->create([
                'comment'=>request()->comment,
                'commentable_id'=>$post_id
            ]);
        }

        return to_route('posts.show',['post'=>$post_id]);
    }
    public function EditComment($post_id,$comment_id){
        $post = Post::find($post_id);
        if($post){
            $post->comments()->where('id', $comment_id)->update([
                'comment'=>request()->comment,
            ]);
        }

        return to_route('posts.show',['post'=>$post_id]);

    }
    public function DeleteComment($post_id,$comment_id){
        $post = Post::find($post_id);
        if($post){
            $post->comments()->find($comment_id)->delete();
        }
        return to_route('posts.show',['post'=>$post_id]);
    }

}
