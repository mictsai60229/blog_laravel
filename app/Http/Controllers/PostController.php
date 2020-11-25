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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blogs = DB::table('blogs')->select('id', 'name', 'title', 'created_at')
                             ->latest()
                             ->limit(5)
                             ->get();
        $response_data = [
            'blogs' => $blogs,
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

    /*
    public function delete()
    {
        return view('delete');
    }

    public function read()
    {
        return view('read');
    }

    public function update()
    {
        return view('update');
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
            $blogs = DB::table('blogs')->select('name', 'title', 'content', 'created_at')
                             ->where('id', '=', $post_id)
                             ->get();
        }
        else{
            $blogs = DB::table('blogs')->select('name', 'title', 'content', 'created_at')
                             ->latest()
                             ->get();
        }

        if (sizeof($blogs) == 0){
            return redirect()->route('home');
        }

        $blog = $blogs[0];

        $response_data = [
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
