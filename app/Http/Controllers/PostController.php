<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(8);
        return $posts;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(25);
        return $posts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'file' => 'nullable',
        ]);

        $exploded = explode(',', $request->file);
        $decoded = base64_decode($exploded[1]);

        if(str_contains($exploded[0], 'jpeg')) {
            $extension = 'jpg';
        } else {
            $extension = 'png';
        }

        $fileName = str_random().'.'.$extension;

        $path = public_path().'/'.$fileName;

        file_put_contents($path, $decoded);

        Post::create($request->except('file') + [
            'file' => $fileName,
        ]);

        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'file' => 'nullable',
        ]);

        if($request->file != '') {
            $exploded = explode(',', $request->file);
            $decoded = base64_decode($exploded[1]);

            if(str_contains($exploded[0], 'jpeg')) {
                $extension = 'jpg';
            } else {
                $extension = 'png';
            }

            $fileName = str_random().'.'.$extension;

            $path = public_path().'/'.$fileName;

            file_put_contents($path, $decoded);

            Post::find($id)->update($request->except('file') + [
                'file' => $fileName,
            ]);
        } else {
            Post::find($id)->update($request->except('file'));
        }

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
        }
    }
}
