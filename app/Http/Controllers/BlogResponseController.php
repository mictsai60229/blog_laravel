<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\BlogResponse;
use Illuminate\Http\Request;
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
        $this->middleware('auth')->except(['index']);
    }

    public function create(Request $request)
    {
        $comment = $request->input('content');
        $blog_id = $request->input('blog_id');
        $user = $request->user();

        $response_data = [];
        
        if ($comment !== NULL && $blog_id !== NULL){
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
        }
        else{
            $response_data['status'] = 'fail';
        }

        return response()->json($response_data);
    }

    public function delete(Request $request)
    {
        $blog_response_id = $request->input('blog_response_id');
        $user_id = $request->user()->id;

        $response_data = [];
        
        if ($blog_response_id !== NULL){
            DB::table('blog_responses')
                ->where('id', '=', $blog_response_id)
                ->where('user_id', '=', $user_id)
                ->delete();

            $response_data['blog_response_id'] = $blog_response_id;
            $response_data['status'] = 'success';
        }
        else{
            $response_data['status'] = 'fail';
        }

        return response()->json($response_data);
    }
}