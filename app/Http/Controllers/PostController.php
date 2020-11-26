<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $blogs = DB::table('blogs')->select('id', 'user_id', 'name', 'title', 'created_at')
                             ->latest()
                             ->limit(5)
                             ->get();
        
        if ($request->user() === NULL){
            $user_id = -1;
        }
        else{
            $user_id = $request->user()->id;
        }
        
        $response_data = [
            'blogs' => $blogs,
            'user_id' => $user_id,
        ];
        
        return view('home', $response_data);
    }

    public function create(Request $request)
    {
        $user_id = $request->user()->id;
        $name = $request->user()->name;
        $title = $request->input('blog-title');
        $content = $request->input('blog-textarea');

        $blog = new Blog;

        $blog -> name = $name;
        $blog -> user_id = $user_id;
        $blog -> title = $title;
        $blog -> content = $content;

        $blog->save();
        return redirect()->route('home');
    }
        
    public function delete(Request $request)
    {
        $user_id = $request->user()->id;
        $post_id = $request->input('post_id');
        $blog = DB::table('blogs')
            ->select('user_id')
            ->where('id', '=', $post_id)
            ->first();
        if ($user_id === $blog->user_id){
            DB::table('blogs')
                ->where('id', '=', $post_id)
                ->delete();
        }

        return redirect()->route('home');
    }

    public function update_index(Request $request)
    {
        $user_id = $request->user()->id;
        $post_id = $request->input('post_id');

        $blog = DB::table('blogs')
            ->select('id', 'user_id', 'title', 'content')
            ->where('id', '=', $post_id)
            ->first();
        
        if ($post_id === NULL || $blog === NULL || $user_id !== $blog->user_id){
                return redirect()->route('home');
        }
        $response_data = [
            'post_id' => $blog->id,
            'post_title' => $blog->title,
            'post_content' => $blog->content,
        ];

        return view('edit', $response_data);
    }

    public function update(Request $request)
    {
        $user_id = $request->user()->id;
        $post_id = $request->input('post_id');

        if ($post_id === NULL){
            return redirect()->route('home');
        }

        $update_array = [
            'title' => $request->input('blog-title'),
            'content' => $request->input('blog-textarea'),
        ];

        Blog::where('id', $post_id)
            ->where('user_id', $user_id)
            ->update($update_array);

        return redirect()->route('show', ['post_id' => $post_id]);
    }

    /*

    

    public function search()
    {
    
    }
    */

    public function show(Request $request)
    {
        if ($request->has('post_id')){
            $post_id = $request->input('post_id');
        }
        else{
            $post_id = -1;
        }

        if ($post_id !== -1){
            $blogs = DB::table('blogs')->select('id', 'user_id', 'name', 'title', 'content', 'created_at')
                             ->where('id', '=', $post_id)
                             ->get();
        }
        else{
            $blogs = DB::table('blogs')->select('id', 'user_id', 'name', 'title', 'content', 'created_at')
                             ->latest()
                             ->get();
        }

        if (sizeof($blogs) == 0){
            return redirect()->route('home');
        }

        $blog = $blogs[0];
        if ($request->user() === NULL)
            $user_id = -1;
        else
            $user_id = $request->user()->id;

        $response_data = [
            'user_id' => $user_id,
            'post_id' => $post_id,
            'post_user_id' => $blog->user_id,
            'post_name' => $blog->name,
            'post_title' => $blog->title,
            'post_content' => $blog->content,
            'date' => $blog->created_at,
        ];

        
        
        return view('show', $response_data);
    }

    public function post()
    {
        return view('post');
    }
}
