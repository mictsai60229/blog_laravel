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
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <form action="/update_blog" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="blog_id" value="{{$blog_id}}">
          <div class="form-group">
            <label for="blog_title">Title</label>
            <input type="text" class="form-control" id="blog_title" name="blog_title" value="{{$blog_title}}">
          </div>
          <div class="form-group">
            <label for="blog_img">Picture(not required)</label>
            <input type="file" class="form-control-file" id="blog_img", name="blog_img">
          </div>
          <div class="form-group">
            <label for="blog_textarea">Content</label>
            <textarea class="form-control" id="blog_textarea" name="blog_textarea" rows="20">{{$blog_content}}</textarea>
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