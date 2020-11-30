<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class BLogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'search']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $blogs = $this->search($request->input('query'));
        $user_id = $request->user()?$request->user()->id:-1;
        
        $response_data = [
            'query' => $request->input('query'),
            'blogs' => $blogs,
            'user_id' => $user_id,
        ];
        
        return view('home', $response_data);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'blog_title' => 'required|max:255',
            'blog_textarea' => 'required',
            'blog_img' => 'nullable|sometimes|image|mimes:jpeg,bmp,png,jpg',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }


        $user_id = $request->user()->id;
        $name = $request->user()->name;
        $title = $request->input('blog_title');
        $image = $request->has('blog_img')?$this->save_image($request->file('blog_img')):NULL;
        $content = $request->input('blog_textarea');

        $blog = new Blog;

        $blog -> name = $name;
        $blog -> user_id = $user_id;
        $blog -> title = $title;
        $blog -> image = $image;
        $blog -> content = $content;

        $blog->save();
        return redirect()->route('show', ['blog_id' => $blog->id]);
    }
        
    public function delete(Request $request)
    {
        $user_id = $request->user()->id;
        $blog_id = $request->input('blog_id');
        $blog = Blog::findOrFail($blog_id);
        if ($user_id === $blog->user_id){
            DB::table('blogs')
                ->where('id', '=', $blog_id)
                ->delete();

            $this->delete_image($blog->image);
        }

        return redirect()->route('home');
    }

    public function update_index(Request $request)
    {
        $user_id = $request->user()->id;
        $blog_id = $request->input('blog_id');

        $blog = Blog::findOrFail($blog_id);
        
        if ($user_id !== $blog->user_id){
                return redirect()->route('home');
        }
        $response_data = [
            'blog_id' => $blog->id,
            'blog_title' => $blog->title,
            'blog_content' => $blog->content,
        ];

        return view('edit', $response_data);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'blog_id' => 'required|exists:blogs,id',
            'blog_title' => 'required|max:255',
            'blog_textarea' => 'required',
            'blog_img' => 'nullable|sometimes|image|mimes:jpeg,bmp,png,jpg',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator);
        }

        $user_id = $request->user()->id;
        $blog_id = $request->input('blog_id');

        $blog = Blog::findorfail($blog_id);
        if ($blog->user_id != $user_id){
            return redirect()->route('show', ['blog_id' => $blog_id]);
        }

        $blog->title = $request->input('blog_title');
        $blog->content = $request->input('blog_textarea');

        if ($request->has('blog_img')){
            $this->delete_image($blog->image);
            $blog->image = $this->save_image($request->file('blog_img'));
        }

        $blog->save();

        return redirect()->route('show', ['blog_id' => $blog_id]);
    }

    public function show(Request $request)
    {

        if ($request->has('blog_id')){
            $blog_id = $request->input('blog_id');
            $blogs = DB::table('blogs')
                ->where('id', '=', $blog_id)
                ->get();
        }
        else{
            $blog_id = -1;
            $blogs = DB::table('blogs')
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
            'blog_id' => $blog_id,
            'blog_user_id' => $blog->user_id,
            'blog_name' => $blog->name,
            'blog_title' => $blog->title,
            'blog_img' => $blog->image,
            'blog_content' => explode("\n", $blog->content),
            'blog_responses' => $this->get_blog_response($blog_id),
            'date' => $blog->created_at,
        ];
        
        return view('show', $response_data);
    }

    public function post()
    {
        return view('post');
    }

    private function search($query)
    {
        if (empty($query)){
            $blogs = DB::table('blogs')->
                orderby('created_at', 'desc')
                ->paginate(5);
        }
        else{
            $sql_query = "%".$query."%";
            $blogs = DB::table('blogs')
                ->where('title', 'like', $sql_query)
                ->orWhere('content', 'like', $sql_query)
                ->orderby('created_at', 'desc')
                ->paginate(5);
        }

        return $blogs;

    }


    private function get_blog_response($blog_id){
        return DB::table("blog_responses")
            ->select('id', 'user_id', 'name', 'content', 'created_at')
            ->where('blog_id', '=', $blog_id)
            ->latest()
            ->get();
                  
    }

    private function save_image($image_file){
        
        $img = Image::make($image_file);
        $file_types = explode('/', $img->mime());
        $mime = end($file_types);
        $name = sprintf("%s.%s", uniqid(), $mime);
        
        $img->save('img/blogs/'.$name);

        return $name;
    }

    private function delete_image($image_file){
        // TODO: probably soft delete method

        return;
    }
}
