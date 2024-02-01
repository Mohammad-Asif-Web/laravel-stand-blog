<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                {{-- Single link --}}
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{route('back.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Profile
                </a>
                {{-- Dropdown link --}}
                <div class="sb-sidenav-menu-heading">Interface</div>
                                    {{-- category --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#category" aria-expanded="false" aria-controls="category">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="category" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('category.create')}}">Create Category</a>
                        <a class="nav-link" href="{{route('category.index')}}">Category List</a>
                    </nav>
                </div>
                                    {{--sub category --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#sub-category" aria-expanded="false" aria-controls="sub-category">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Sub Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="sub-category" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('sub-category.create')}}">Create Sub Category</a>
                        <a class="nav-link" href="{{route('sub-category.index')}}">Sub Category List</a>
                    </nav>
                </div>
                                    {{-- tag --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#Tags" aria-expanded="false" aria-controls="Tags">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Tag
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="Tags" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('tag.create')}}">Create Tag</a>
                        <a class="nav-link" href="{{route('tag.index')}}">Tag List</a>
                    </nav>
                </div>
                                    {{-- post --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#posts" aria-expanded="false" aria-controls="posts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Post
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="posts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="layout-static.html">Create Post</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Post List</a>
                    </nav>
                </div>

                {{-- Single link--}}
                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="{{route('blank')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Blank Page
                </a>
                <a class="nav-link" href="javascript:void(0)">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Calculate
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>