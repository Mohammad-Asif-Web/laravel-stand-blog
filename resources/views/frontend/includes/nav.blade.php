<header class="">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="{{route('front.index')}}"><h2>Stand Blog<em>.</em></h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{route('front.index')}}">{{__('translate.Home')}}
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('front.about')}}">{{__('translate.About Us')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('front.all-posts')}}">{{__('translate.Blogs')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('front.contact')}}">{{__('translate.Contact Us')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('login')}}">{{__('translate.Admin Sign In')}}</a>
            </li>
            <li class="nav-item">
              <select name="" id="language_switcher" class="form-control top-selector">
                <option>{{ Config::get('languages')[App::getLocale()] }}</option>
                @foreach ( Config::get('languages') as $lang => $language )
                    @if ($lang != App::getLocale() )
                        <option value="{{$lang}}">
                            <a href="" class="dropdown-item">{{$language}}</a>
                        </option>
                    @endif
                @endforeach
              </select>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  @push('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
    $("#language_switcher").on("change", function(event) {
        event.preventDefault();
        let domainName = window.location.origin;
        var lang = $(this).val();

        axios.get(`${domainName}/lang/${lang}`)
        .then(function () {
            window.location.reload()
        }).catch(function () {
            window.location.reload();
        });

    });
    </script>
  @endpush

