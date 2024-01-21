<!DOCTYPE html>
<html lang="en">

  <head>
    @include('frontend.includes.head')
  </head>

  <body>
    <!-- Header -->
    @include('frontend.includes.nav')

    {{-- banner --}}
    @yield('banner')

    {{-- content --}}
    <section class="blog-posts">
      <div class="container">
        <div class="row">
          {{-- Main Content --}}
           @yield('content')
        </div>
      </div>
    </section>

    {{-- footer --}}
    @include('frontend.includes.footer')
    {{-- script JS --}}
    @include('frontend.includes.script')

  </body>
</html>





