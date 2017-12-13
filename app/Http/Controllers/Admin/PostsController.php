<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PostFormRequest;
use App\Http\Requests\PostEditFormRequest;
use App\Http\Controllers\Controller;
use App\Category;
use App\Post;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //Ver todos los posts
        $posts = Post::all();
        return view('backend.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //Crea nuevo post
        $categories = Category::all();
        return view('backend.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(PostFormRequest $request)
    {
        //Guarda un nuevo post
        $post = new Post(array(
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'slug' => Str::slug($request->get('title'),'-'),
        ));

        $post->save();
        $post->categories()->sync($request->get('categories'));

        return redirect('admin/posts/create')->with('status', 'The post has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //edita un post existente
        $post = Post::whereId($id)->firstOrFail();
        $categories = Category::all();
        $selectedCategories = $post->categories->lists('id')->toArray();
        return view('backend.posts.edit', compact('post', 'categories', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(PostEditFormRequest $request, $id)
    {
        //Actualiza un post
        $post = post::whereId($id)->firstOrFail();
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->slug = Str::slug($request->get('title'), '-');

        $post->save();
        $post->categories()->sync($request->get('categories'));

        return redirect(action('Admin\PostsController@edit', $post->id))->with('status', 'The post has been updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}