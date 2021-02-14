<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
    <link rel="icon" href="{{ asset('favicon.ico') }} " />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Matomo -->
    <script type="text/javascript">
    var _paq = window._paq || [];
    /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
        var u="//pwk.psln.nl/";
        _paq.push(['setTrackerUrl', u+'matomo.php']);
        _paq.push(['setSiteId', '11']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
    })();
    </script>
    <noscript><p><img src="//pwk.psln.nl/matomo.php?idsite=11&amp;rec=1" style="border:0;" alt="" /></p></noscript>
    <!-- End Matomo Code -->
</head>

<body id="app">
<div class="container px-4">
    <div class="row">
        <main role="main" class="col-12">
            <nav class="container navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('public.podcast.show', ['uuid' => $lddm->uuid]) }}">
                                <i class="fas fa-podcast" aria-hidden="true"></i>
                                {{ $lddm->name }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('public.contact.index') }}">
                                <i class="fas fa-address-book" aria-hidden="true"></i>
                                @ucfirst(__('app.contacts'))
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-podcast" aria-hidden="true"></i>
                                @ucfirst(__('app.menuConsoles'))
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <a class="dropdown-item" href="{{ route('public.manufacturer.index') }}">
                                    <i class="fas fa-industry" aria-hidden="true"></i>
                                    @ucfirst(__('app.manufacturers'))
                                </a>
                                <a class="dropdown-item" href="{{ route('public.console.index') }}">
                                    <i class="fas fa-dice" aria-hidden="true"></i>
                                    @ucfirst(__('app.consoles'))
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-gamepad" aria-hidden="true"></i>
                                @ucfirst(__('app.menuGames'))
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown02">
                                <a class="dropdown-item" href="{{ route('public.studio.index') }}">
                                    <i class="fas fa-terminal" aria-hidden="true"></i>
                                    @ucfirst(__('app.studios'))
                                </a>
                                <a class="dropdown-item" href="{{ route('public.genre.index') }}">
                                    <i class="fas fa-list-alt" aria-hidden="true"></i>
                                    @ucfirst(__('app.genres'))
                                </a>
                                <a class="dropdown-item" href="{{ route('public.game.index') }}">
                                    <i class="fas fa-gamepad" aria-hidden="true"></i>
                                    @ucfirst(__('app.games'))
                                </a>
                                <a class="dropdown-item" href="{{ route('public.track.index') }}">
                                    <i class="fas fa-music" aria-hidden="true"></i>
                                    @ucfirst(__('app.tracks'))
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-chart-bar" aria-hidden="true"></i>
                                @ucfirst(__('app.menuStatistics'))
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown03">
                                <a class="dropdown-item" href="{{ route('public.stats.episodes') }}">
                                    <i class="fas fa-chart-bar" aria-hidden="true"></i>
                                    @ucfirst(__('app.podcastStats'))
                                </a>
                                <a class="dropdown-item" href="{{ route('public.stats.seasons') }}">
                                    <i class="fas fa-chart-bar" aria-hidden="true"></i>
                                    @ucfirst(__('app.seasonsStats'))
                                </a>
                                <a class="dropdown-item" href="{{ route('public.stats.countries') }}">
                                    <i class="fas fa-chart-bar" aria-hidden="true"></i>
                                    @ucfirst(__('app.countriesStats'))
                                </a>
                                <a class="dropdown-item" href="{{ route('public.stats.contacts') }}">
                                    <i class="fas fa-chart-bar" aria-hidden="true"></i>
                                    @ucfirst(__('app.contactsStats'))
                                </a>
                                <a class="dropdown-item" href="{{ route('public.stats.studios') }}">
                                    <i class="fas fa-chart-bar" aria-hidden="true"></i>
                                    @ucfirst(__('app.studiosStats'))
                                </a>
                                <a class="dropdown-item" href="{{ route('public.stats.games') }}">
                                    <i class="fas fa-chart-bar" aria-hidden="true"></i>
                                    @ucfirst(__('app.gamesStats'))
                                </a>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav  mt-2 mt-md-0">
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
                                <span class="sr-only">@ucfirst(__('auth.login'))</span>
                            </a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus" aria-hidden="true"></i>
                                @ucfirst(__('auth.register'))
                            </a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.index') }}">
                                <i class="fas fa-tools" aria-hidden="true"></i>
                                @ucfirst(__('app.admin'))
                            </a>
                        </li>
                        <form action="{{ route('logout') }}" method="POST" class="form-inline" id="logout-form">
                            @csrf
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                                <span class="sr-only">@ucfirst(__('auth.logout'))</span>
                            </a>
                        </form>
                        @endguest
                    </ul>
                </div>
            </nav>
            
            @if ($errors->any())
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4">
                <div class="col alert alert-danger">
                    <ol>
                        @foreach ($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ol>
                </div>
            </div>
            @endif
        
            @yield('content')
            
            @include('layouts.footer')
        </main>
    </div>
</div>
    
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('js')
</body>
</html>
