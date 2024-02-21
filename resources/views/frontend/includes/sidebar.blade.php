<div class="col-lg-4">
    <div class="sidebar">
      <div class="row">
        <div class="col-lg-12">
          <div class="sidebar-item">
            {{-- Dynamic Search post Panel --}}
            {!! Form::open(['method'=>'get', 'route'=>'front.search']) !!}
            <div class="input-group">
              {!! Form::search('search', null, ['class'=>'form-control', 'placeholder'=>'type to search...']) !!}
              {!! Form::button('<i class="fa fa-search" aria-hidden="true"></i>', ['type'=>'submit','class'=>'btn btn-success input-group-text']) !!}
            </div>
            {!! Form::close() !!}
          </div>
        </div>
        <div class="col-lg-12">
          <div class="sidebar-item recent-posts">
            <div class="sidebar-heading">
              <h2>Recent Posts</h2>
            </div>
            <div class="content">
              <ul>
                @foreach ($my_recent_posts as $post)
                  <li><a href="{{route('front.single', $post->slug)}}">
                    <h5>{{$post->title}}</h5>
                    <span>{{$post->created_at->format('M d, Y')}}</span>
                  </a></li>
                @endforeach
                
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="sidebar-item categories">
            <div class="sidebar-heading">
              <h2>Categories</h2>
            </div>
            <div class="content">
              <ul>
                @foreach ($my_categories as $category)
                <li><a href="{{route('front.category', $category->slug)}}">{{$category->name}}</a>
                  <ul class="sidebar-sub">
                    @foreach ($category->sub_categories as $sub_category)
                      <li class="sub-list"><a href="{{route('front.sub-category', [$category->slug, $sub_category->slug])}}">-{{$sub_category->name}}</a>
                    @endforeach
                  </ul>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="sidebar-item tags">
            <div class="sidebar-heading">
              <h2>Tag Clouds</h2>
            </div>
            <div class="content">
              <ul>
                @foreach ($my_tags as $tag)
                  <li><a href="{{route('front.tag', $tag->slug)}}">{{$tag->name}}</a></li>
                @endforeach
                
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>