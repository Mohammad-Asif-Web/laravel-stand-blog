@extends('frontend.layouts.master')

@section('page_title', 'Single Post')

@section('banner')
<div class="heading-page header-text">
    <section class="page-heading">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-content">
              <h4>{{$sub_title}}</h4>
              <h2>{{$title}}</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('content')
<section class="blog-posts grid-system">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
            <div class="all-blog-posts">
                <div class="row">
                  @foreach ($all_posts as $post)
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
                    @if (count($all_posts) < 1)
                        <h2 class="w-100 text-center text-danger">No Post Found!</h2>
                    @endif
                    <div class="col-lg-12">
                        {{$all_posts->links()}}
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