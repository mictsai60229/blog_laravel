@extends('master')

@section('bg-img-url', 'img/post-bg.jpg')
@section('header-title', 'Write anything and everything!!!')
@section('header-subtitle', '')

@section('content')
  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
        <form action="/update_post" method="post">
          @csrf
          <input type="hidden" name="post_id" value="{{$post_id}}">
          <div class="form-group">
            <label for="blog-title">Title</label>
            <input type="text" class="form-control" id="blog-title" name="blog-title" value="{{$post_title}}">
          </div>
          <div class="form-group">
            
            <label for="blog-textarea">Content</label>
            <textarea class="form-control" id="blog-textarea" name="blog-textarea" rows="20">{{$post_content}}</textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary mb-2" style="float: right;">Submit</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </article>

  <hr>
  @endsection