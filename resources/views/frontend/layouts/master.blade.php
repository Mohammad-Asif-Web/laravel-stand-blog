<!DOCTYPE html>
<html lang="en">

  <head>
    @include('frontend.includes.head')
  </head>

  <body>
    <!-- Nav bar -->
    @include('frontend.includes.nav')
    <!-- Banner Starts Here -->
    @yield('banner')

    {{-- content --}}
    @yield('content')

    {{-- Footer --}}
    @include('frontend.includes.footer')
    {{-- Scripts JS --}}
    @include('frontend.includes.scripts')

  </body>
</html>
