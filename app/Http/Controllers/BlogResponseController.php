<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\BlogResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BlogResponseController extends Controller
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

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'blog_id' => 'required|exists:blogs,id',
            'content' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json(['status'=> "fail"]);
        }

        $comment = $request->input('content');
        $blog_id = $request->input('blog_id');
        $user = $request->user();

        $response_data = array();
        
        $blog_response = new BlogResponse;
        $blog_response->user_id = $user->id;
        $blog_response->name = $user->name;
        $blog_response->blog_id = $blog_id;
        $blog_response->content = $comment;

        $blog_response->save();

        $response_data['id'] = $blog_response->id;
        $response_data['status'] = 'success';
        $response_data['name'] = $user->name;
        $response_data['created_at'] = Carbon::now()->toDateTimeString();

        return response()->json($response_data);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'blog_response_id' => 'required|exists:blog_responses,id',
        ]);

        if ($validator->fails()){
            return response()->json(['status'=> "fail"]);
        }
        $blog_response_id = $request->input('blog_response_id');
        $user_id = $request->user()->id;

        $response_data = [];
        
        DB::table('blog_responses')
            ->where('id', '=', $blog_response_id)
            ->where('user_id', '=', $user_id)
            ->delete();

        $response_data['blog_response_id'] = $blog_response_id;
        $response_data['status'] = 'success';


        return response()->json($response_data);
    }
}