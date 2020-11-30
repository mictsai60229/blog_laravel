@extends('master')

@section('bg-img-url', 'img/show-bg.jpg')
@section('header-title', $blog_title)
@section('header-subtitle')
Posted by {{$blog_name}} on {{$date}}
@endsection



@section('content')
  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          @if ($user_id === $blog_user_id)
          <div class="clearfix">
          <form action="/delete_blog", method="post">
            @csrf
            <input type="hidden" name="blog_id" value="{{$blog_id}}">
            <button type="submit" class="btn btn-primary float-right" style="float: right;">Delete</button>
          </form>
          <form action="/update_blog", method="get">
            <input type="hidden" name="blog_id" value="{{$blog_id}}">
            <button type="submit" class="btn btn-primary float-right" style="float: right;">Edit</button>
          </form>
        </div>
        @endif
        @foreach ($blog_content as $content)
          <p>{{$content}}</p>
        @endforeach
        </div>
      </div>
    </div>
  </article>

  <hr>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
  <div class="detailBox">
    <div class="titleBox">
      <label>Comment Box</label>
    </div>
    <div class="actionBox">
        <ul class="commentList" id="comment-area">
            @foreach ($blog_responses as $blog_response)
            <li>
              <div class="commentText" id="blog_response_{{$blog_response->id}}">
                  <b class="" style="color: blue">{{$blog_response->name}}</b>
                  @if ($user_id  === $blog_response->user_id)
                  <button onclick="delete_blog_response({{$blog_response->id}})" class="btn btn-danger btn-sm">delete</button>
                  @endif
                  <p class="">{{$blog_response->content}}</p>
                  <span class="date sub-text">{{$blog_response->created_at}}</span>
                </div>
            </li>
            @endforeach
        </ul>
        <form class="form-inline" role="form">
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Your comments" name="comment_text" id="comment_text">
            </div>
            <div class="form-group">
                <button class="btn btn-default create-blog-response">Add</button>
            </div>
            <div class="form-group">
              <input type="hidden" name="blog_id" value="{{$blog_id}}">
          </div>
        </form>
    </div>
  </div>
</div>
</div>
</div>


  <hr>
@endsection