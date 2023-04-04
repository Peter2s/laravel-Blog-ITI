<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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
       return view('posts.edit',['post'=>[]]);
    }
    public function show($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        return view('posts.show',['post'=>$post]);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $post = Post::create($data);
        return to_route('posts.index');
    }
    public function update($post_id)
    {
        return to_route('posts.index');
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
    public function EditComment($comment){

    }
    public function DeleteComment($comment){

    }

}
