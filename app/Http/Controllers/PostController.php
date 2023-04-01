<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{   
    public function index(){
            $posts = [
                [
                    'id' => 1,
                    'title' => 'laravel',
                    'posted_by' => 'peter',
                    'created_at' => '2023-04-01 10:00:00',
                ],

                [
                    'id' => 2,
                    'title' => 'PHP',
                    'posted_by' => 'salah',
                    'created_at' => '2023-04-01 10:00:00',
                ],

                [
                    'id' => 3,
                    'title' => 'Javascript',
                    'posted_by' => 'samir',
                    'created_at' => '2023-04-01 10:00:00',
                ],
            ];

        return view('posts.index',['posts'=>$posts]);
    }

    public function create(){
        return view('posts.create');
    }
    public function edit($post)
    {
        $post = [
            'id' => 1,
            'title' => 'laravel',
            'posted_by' => 'peter',
            'created_at' => '2023-04-01 10:00:00',
        ];
        return view('posts.edit',['post'=>$post]);
    }
    public function show($post)
    {
        $post = [
            'id' => 1,
            'title' => 'laravel',
            'posted_by' => 'peter',
            'created_at' => '2023-04-01 10:00:00',
        ];
        return view('posts.show',['post'=>$post]);
    }
    public function store()
    {
        return redirect()->route('posts.index');
    }
    public function update($post)
    {
        return redirect()->route('posts.index');
    }
    public function destroy($post)
    {
        return redirect()->route('posts.index');
    }
}
