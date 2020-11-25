@extends('master')

@section('bg-img-url', 'img/post-bg.jpg')
@section('header-title', 'Write anythiny and everything!!!')
@section('header-subtitle', '')

@section('content')
  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
        <form action="/create_post" method="post">
          <div class="form-group">
            <label for="blog-title">Title</label>
            <input type="text" class="form-control" id="blog-title" name="blog-title">
          </div>


          <div class="form-group">
            @csrf
            <label for="blog-textarea">Content</label>
            <textarea class="form-control" id="blog-textarea" name="blog-textarea" rows="20"></textarea>
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

