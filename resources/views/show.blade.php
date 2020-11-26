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
@endsection