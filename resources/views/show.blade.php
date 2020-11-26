@extends('master')

@section('bg-img-url', 'img/show-bg.jpg')
@section('header-title', $post_title)
@section('header-subtitle')
Posted by {{$post_name}} on {{$date}}
@endsection



@section('content')
  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          @if ($user_id === $post_user_id)
          <div class="clearfix">
          <form action="/delete_post", method="post">
            @csrf
            <input type="hidden" name="post_id" value="{{$post_id}}">
            <button type="submit" class="btn btn-primary float-right" style="float: right;">Delete</button>
          </form>
          <form action="/update_post", method="get">
            <input type="hidden" name="post_id" value="{{$post_id}}">
            <button type="submit" class="btn btn-primary float-right" style="float: right;">Edit</button>
          </form>
        </div>
        @endif
        <p>{{$post_content}}</p>
        </div>
      </div>
    </div>
  </article>

  <hr>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
  <div class="detailBox">
    <div class="actionBox">
        <ul class="commentList">
            <li>
                <div class="commentText">
                     <a href="#">Joe</a>
                    <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>

                </div>
            </li>
            <li>
                <div class="commentText">
                    <a href="#">Joe</a>
                    <p class="">Hello this is a test comment and this comment is particularly very long and it goes on and on and on.</p> <span class="date sub-text">on March 5th, 2014</span>

                </div>
            </li>
            <li>
                <div class="commentText">
                    <a href="#">Joe</a>
                    <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>
                </div>
            </li>
        </ul>
        <form class="form-inline" role="form">
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Your comments" />
            </div>
            <div class="form-group">
                <button class="btn btn-default">Add</button>
            </div>
        </form>
    </div>
  </div>
</div>
</div>
</div>


  <hr>
@endsection