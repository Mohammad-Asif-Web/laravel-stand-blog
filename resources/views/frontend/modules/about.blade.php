@extends('frontend.layouts.master')
@section('title', 'Single Post')

@section('banner')
<div class="heading-page header-text">
    <section class="page-heading">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-content">
              <h4>about us</h4>
              <h2>more about us!</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="blog-post">
      <div class="blog-thumb">
        <img src="{{asset('frontend/assets/images/blog-post-02.jpg')}}" alt="">
      </div>
      <div class="down-content">
        <span>Lifestyle</span>
        <a href="post-details.html"><h4>Aenean pulvinar gravida sem nec</h4></a>
        <ul class="post-info">
          <li><a href="#">Admin</a></li>
          <li><a href="#">May 12, 2020</a></li>
          <li><a href="#">10 Comments</a></li>
        </ul>
        <p>You can browse different tags such as <a rel="nofollow" href="https://templatemo.com/tag/multi-page" target="_parent">multi-page</a>, <a rel="nofollow" href="https://templatemo.com/tag/resume" target="_parent">resume</a>, <a rel="nofollow" href="https://templatemo.com/tag/video" target="_parent">video</a>, etc. to see more CSS templates. Sed hendrerit rutrum arcu, non malesuada nisi. Sed id facilisis turpis. Donec justo elit, dapibus vel ultricies in, molestie sit amet risus. In nunc augue, rhoncus sed libero et, tincidunt tempor nisl. Donec egestas, quam eu rutrum ultrices, sapien ante posuere nisl, ac eleifend eros orci vel ante. Pellentesque vitae eleifend velit. Etiam blandit felis sollicitudin vestibulum feugiat.
        <br><br>Donec tincidunt leo nec magna gravida varius. Suspendisse felis orci, egestas ac sodales quis, venenatis et neque. Vivamus facilisis dignissim arcu et blandit. Maecenas finibus dui non pulvinar lacinia. Ut lacinia finibus lorem vel porttitor. Suspendisse et metus nec libero ultrices varius eget in risus. Cras id nibh at erat pulvinar malesuada et non ipsum. Suspendisse id ipsum leo.</p>
        <div class="post-options">
          <div class="row">
            <div class="col-6">
              <ul class="post-tags">
                <li><i class="fa fa-tags"></i></li>
                <li><a href="#">Best Templates</a>,</li>
                <li><a href="#">TemplateMo</a></li>
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
  <div class="col-lg-12">
    <div class="sidebar-item comments">
      <div class="sidebar-heading">
        <h2>4 comments</h2>
      </div>
      <div class="content">
        <ul>
          <li>
            <div class="author-thumb">
              <img src="{{asset('frontend/assets/images/comment-author-01.jpg')}}" alt="">
            </div>
            <div class="right-content">
              <h4>Charles Kate<span>May 16, 2020</span></h4>
              <p>Fusce ornare mollis eros. Duis et diam vitae justo fringilla condimentum eu quis leo. Vestibulum id turpis porttitor sapien facilisis scelerisque. Curabitur a nisl eu lacus convallis eleifend posuere id tellus.</p>
            </div>
          </li>
          <li class="replied">
            <div class="author-thumb">
              <img src="{{asset('frontend/assets/images/comment-author-02.jpg')}}" alt="">
            </div>
            <div class="right-content">
              <h4>Thirteen Man<span>May 20, 2020</span></h4>
              <p>In porta urna sed venenatis sollicitudin. Praesent urna sem, pulvinar vel mattis eget.</p>
            </div>
          </li>
          <li>
            <div class="author-thumb">
              <img src="{{asset('frontend/assets/images/comment-author-03.jpg')}}" alt="">
            </div>
            <div class="right-content">
              <h4>Belisimo Mama<span>May 16, 2020</span></h4>
              <p>Nullam nec pharetra nibh. Cras tortor nulla, faucibus id tincidunt in, ultrices eget ligula. Sed vitae suscipit ligula. Vestibulum id turpis volutpat, lobortis turpis ac, molestie nibh.</p>
            </div>
          </li>
          <li class="replied">
            <div class="author-thumb">
              <img src="{{asset('frontend/assets/images/comment-author-02.jpg')}}" alt="">
            </div>
            <div class="right-content">
              <h4>Thirteen Man<span>May 22, 2020</span></h4>
              <p>Mauris sit amet justo vulputate, cursus massa congue, vestibulum odio. Aenean elit nunc, gravida in erat sit amet, feugiat viverra leo.</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="sidebar-item submit-comment">
      <div class="sidebar-heading">
        <h2>Your comment</h2>
      </div>
      <div class="content">
        <form id="comment" action="#" method="post">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <fieldset>
                <input name="name" type="text" id="name" placeholder="Your name" required="">
              </fieldset>
            </div>
            <div class="col-md-6 col-sm-12">
              <fieldset>
                <input name="email" type="text" id="email" placeholder="Your email" required="">
              </fieldset>
            </div>
            <div class="col-md-12 col-sm-12">
              <fieldset>
                <input name="subject" type="text" id="subject" placeholder="Subject">
              </fieldset>
            </div>
            <div class="col-lg-12">
              <fieldset>
                <textarea name="message" rows="6" id="message" placeholder="Type your comment" required=""></textarea>
              </fieldset>
            </div>
            <div class="col-lg-12">
              <fieldset>
                <button type="submit" id="form-submit" class="main-button">Submit</button>
              </fieldset>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection