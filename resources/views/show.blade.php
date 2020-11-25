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
        <p>{{$post_content}}</p>
        </div>
      </div>
    </div>
  </article>

  <hr>
@endsection