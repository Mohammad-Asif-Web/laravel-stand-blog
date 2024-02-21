@extends('frontend.layouts.master')

@section('page_title', 'Blog Home Page')

@section('banner')
<div class="main-banner header-text">
    <div class="container-fluid">
      <div class="owl-banner owl-carousel">

        @foreach ($slider_posts as $post)
        <div class="item">
          <img src="{{url('images/original/'.$post->photo)}}" alt="{{$post->title}}">
          <div class="item-content">
            <div class="main-content">
              <div class="meta-category">
                <span>{{$post->category->name}}</span>
              </div>
              <a href="{{route('front.single', $post->slug)}}"><h4>{{$post->title}}</h4></a>
              <ul class="post-info">
                <li><a href="#">{{$post->user->name}}</a></li>
                <li><a href="#">{{$post->created_at->format('M d, Y')}}</a></li>
                <li><a href="#">12 Comments</a></li>
              </ul>
            </div>
          </div>
        </div>
        @endforeach

      </div>
    </div>
  </div>
@endsection

@section('content')
<section class="blog-posts">
    <div class="container">
        <div class="row">
            {{-- Main Content --}}
            <div class="col-lg-8">
                <div class="all-blog-posts">
                    <div class="row">
                      @foreach ($posts as $post)
                    <div class="col-lg-12">
                        <div class="blog-post">
                            <div class="blog-thumb">
                                <img src="{{url('images/original/'.$post->photo)}}" alt="{{$post->title}}">
                            </div>
                            <div class="down-content">
                                <div class="w-100 d-flex justify-content-between">
                                  <span>{{$post->category->name}}</span>
                                  <span class="text-warning">{{$post->subCategory->name}}</span>
                                </div>
                                <a href="{{route('front.single', $post->slug)}}"><h4>{{$post->title}}</h4></a>
                                <ul class="post-info">
                                <li><a href="#">{{$post->user->name}}</a></li>
                                <li><a href="#">{{$post->created_at->format('M d, Y')}}</a></li>
                                <li><a href="#">12 Comments</a></li>
                                </ul>
                                <p>{{strip_tags(Str::substr($post->description, 0, 400)) }}...
                                  <a href="{{route('front.single', $post->slug)}}" class="btn btn-sm btn-secondary">Read More</a>
                                </p>
                                <div class="post-options">
                                <div class="row">
                                    <div class="col-6">
                                    <ul class="post-tags">
                                        <li><i class="fa fa-tags"></i></li>
                                        @foreach ($post->tag as $tag)
                                        <li><a href="{{route('front.tag', $tag->slug)}}">{{$tag->name}}</a>,</li>
                                        @endforeach
                                        
                                    </ul>
                                    </div>
                                    <div class="col-6">
                                    <ul class="post-share">
                                        <li><i class="fa fa-share-alt"></i></li>
                                        <li><a href="#">Facebook</a>,</li>
                                        <li><a href="#"> Twitter</a></li>
                                    </ul>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-lg-12">
                        <div class="main-button">
                        <a href="{{route('front.all-posts')}}">View All Posts</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            {{-- sidebar --}}
            @include('frontend.includes.sidebar') 
        </div>
    </div>
</section>
@endsection



