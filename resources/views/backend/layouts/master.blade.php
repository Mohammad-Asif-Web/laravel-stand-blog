<!DOCTYPE html>
<html lang="en">
    <head>
        @include('backend.includes.head')
    </head>
    <body class="sb-nav-fixed">
        {{-- Navbar --}}
        @include('backend.includes.nav')
        <div id="layoutSidenav">
            {{-- Sidebar Nav --}}
            @include('backend.includes.sidebar')

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">@yield('title')</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">@yield('sub_title')</li>
                        </ol>
                        @yield('content')
                    </div>
                </main>
                
                {{-- Footer --}}
                @include('backend.includes.footer')
            </div>
        </div>
        {{-- Scripts JS --}}
        @include('backend.includes.scripts')
    </body>
</html>
