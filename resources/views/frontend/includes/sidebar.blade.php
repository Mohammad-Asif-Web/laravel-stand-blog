<div class="col-lg-4">
    <div class="sidebar">
      <div class="row">
        <div class="col-lg-12">
          <div class="sidebar-item search">
            <form id="search_form" name="gs" method="GET" action="#">
              <input type="text" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
            </form>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="sidebar-item recent-posts">
            <div class="sidebar-heading">
              <h2>Recent Posts</h2>
            </div>
            <div class="content">
              <ul>
                <li><a href="post-details.html">
                  <h5>Vestibulum id turpis porttitor sapien facilisis scelerisque</h5>
                  <span>May 31, 2020</span>
                </a></li>
                <li><a href="post-details.html">
                  <h5>Suspendisse et metus nec libero ultrices varius eget in risus</h5>
                  <span>May 28, 2020</span>
                </a></li>
                <li><a href="post-details.html">
                  <h5>Swag hella echo park leggings, shaman cornhole ethical coloring</h5>
                  <span>May 14, 2020</span>
                </a></li>
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
                <li><a href="#">{{$category->name}}</a>
                  <ul class="sidebar-sub">
                    @foreach ($category->sub_categories as $sub_category)
                      <li class="sub-list"><a href="#">-{{$sub_category->name}}</a>
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
                <li><a href="#">Lifestyle</a></li>
                <li><a href="#">Creative</a></li>
                <li><a href="#">HTML5</a></li>
                <li><a href="#">Inspiration</a></li>
                <li><a href="#">Motivation</a></li>
                <li><a href="#">PSD</a></li>
                <li><a href="#">Responsive</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>