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
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

        <form action="/create_blog" method="post">
          @csrf
          <div class="form-group">
            <label for="blog_title">Title</label>
            <input type="text" class="form-control" id="blog_title" name="blog_title">
          </div>
          <div class="form-group">
            
            <label for="blog_textarea">Content</label>
            <textarea class="form-control" id="blog_textarea" name="blog_textarea" rows="20"></textarea>
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

