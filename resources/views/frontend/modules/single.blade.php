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
              {{-- post details --}}
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
                    <p>{!! $post->description !!}
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
              {{-- post comments --}}
              <div class="col-lg-12">
                <div class="sidebar-item comments">
                  <div class="sidebar-heading">
                    <h2>4 comments</h2>
                  </div>
                  <div class="content">
                    <ul>
                      @foreach ($post->comment as $comment)  
                      <li>
                        <div class="author-thumb">
                          <img src="{{asset('frontend/assets/images/comment-author-01.jpg')}}" alt="">
                        </div>
                        <div class="right-content">
                          <h4>{{$comment->user?->name}}<span>{{$comment->created_at->format('M d, Y')}}</span></h4>
                          <p>{{$comment->comment}}</p>
                          
                          {!! Form::open(['method'=>'post', 'route'=>'comment.store']) !!}
                          {!! Form::hidden('post_id', $post->id) !!}
                          {!! Form::hidden('comment_id', $comment->id) !!}
                          {!! Form::textarea('comment', null, ['class'=>'form-control mt-3', 'id'=>'reply-text', 'placeholder'=>'write your reply']) !!}
                          {!! Form::button('Reply', ['class'=>'btn btn-sm btn-outline-success mt-2', 'type'=>'submit']) !!}
                          {!! Form::close() !!}
                        </div>
                      </li>
                        {{-- reply --}}
                        @foreach ($comment->reply as $reply)
                        <li class="replied">
                          <div class="author-thumb">
                            <img src="{{asset('frontend/assets/images/comment-author-02.jpg')}}" alt="">
                          </div>
                          <div class="right-content">
                            <h4>{{$reply->user?->name}}<span>{{$reply->created_at->format('M d, Y')}}</span></h4>
                            <p>{{$reply->comment}}</p>
                          </div>
                        </li>
                        @endforeach

                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
              {{-- submit comment form --}}
              <div class="col-lg-12">
                <div class="sidebar-item submit-comment">
                  <div class="sidebar-heading">
                    <h2>Your comment</h2>
                  </div>
                  <div class="content">
                    <form id="comment" action="{{route('comment.store')}}" method="post">
                      @csrf
                      <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <textarea name="comment" id="message" placeholder="Type your comment"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit"  class="main-button">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
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

  @if (session('msg'))        
    @push('js')
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
            Toast.fire({
                icon: '{{ session('cls') }}',
                title: '{{ session('msg') }}'
            })
        </script>
    @endpush
@endif

@endsection