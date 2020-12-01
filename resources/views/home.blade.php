@extends('master')

@section('bg-img-url', 'img/home-bg.jpg')
@section('header-title', 'Clean Blog')
@section('header-subtitle', 'A Blog Theme by Start Bootstrap')


@section('content')
  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <form class="form-inline" action="/home" method="get">
          <input type="text" class="form-control col-md-9 mb-2 mr-sm-2" id="query" name="query" value="{{$query}}">
          <button type="submit" class="btn btn-primary mb-2">Search</button>
        </form>

        @foreach ($blogs as $blog)
        <div class="post-preview">
          
          <a href="/show?blog_id={{$blog->id}}">
              <h2 class="post-title">
                {{$blog->title}}
              </h2>
          </a>
          <p class="post-meta">Posted by
          <a href="#">{{$blog->name}}</a>
          on {{$blog->created_at}}</p>
        </div>
        @if ($user_id === $blog->user_id)
          <div class="clearfix">
          <form action="/delete_blog", method="post">
            @csrf
            <input type="hidden" name="blog_id" value="{{$blog->id}}">
            <button type="submit" class="btn btn-primary float-right" style="float: right;">Delete</button>
          </form>
          <form action="/post", method="get">
            <input type="hidden" name="blog_id" value="{{$blog->id}}">
            <button type="submit" class="btn btn-primary float-right" style="float: right;">Edit</button>
          </form>
        </div>
        @endif
      
        <hr>
        
        @endforeach
        <!-- Pager -->
        <div class="d-flex justify-content-center">
          {!! $blogs->links() !!}
        </div>
      </div>
    </div>
  </div>

  <hr>
@endsection