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
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link rel="icon" href="{{ asset('favicon.ico') }} " />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}" />
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
                            <a class="nav-link" href="{{ route('admin.index') }}">
                                <i class="fas fa-home" aria-hidden="true"></i>
                                @ucfirst(__('app.admin'))
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-podcast" aria-hidden="true"></i>
                                @ucfirst(__('app.menuPodcasts'))
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <a class="dropdown-item" href="{{ route('admin.podcast.index') }}">
                                    <i class="fas fa-podcast" aria-hidden="true"></i>
                                    @ucfirst(__('app.podcastsList'))
                                </a>
                                @foreach($menuPodcasts as $menuPodcast)
                                <a class="dropdown-item" href="{{ route('admin.podcast.show', ['uuid' => $menuPodcast->uuid]) }}">
                                    <i class="fas fa-podcast" aria-hidden="true"></i>
                                    {{ $menuPodcast->name }}
                                </a>
                                @endforeach
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-users" aria-hidden="true"></i>
                                @ucfirst(__('app.menuContacts'))
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown02">
                                <a class="dropdown-item" href="{{ route('admin.profession.index') }}">
                                    <i class="fas fa-user-tie" aria-hidden="true"></i>
                                    @ucfirst(__('app.professions'))
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.contact.index') }}">
                                    <i class="fas fa-address-book" aria-hidden="true"></i>
                                    @ucfirst(__('app.contacts'))
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.source.index') }}">
                                    <i class="fas fa-link" aria-hidden="true"></i>
                                    @ucfirst(__('app.sources'))
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-gamepad" aria-hidden="true"></i>
                                @ucfirst(__('app.menuGames'))
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown03">
                                <a class="dropdown-item" href="{{ route('admin.manufacturer.index') }}">
                                    <i class="fas fa-industry" aria-hidden="true"></i>
                                    @ucfirst(__('app.manufacturers'))
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.console.index') }}">
                                    <i class="fas fa-dice" aria-hidden="true"></i>
                                    @ucfirst(__('app.consoles'))
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin.studio.index') }}">
                                    <i class="fas fa-terminal" aria-hidden="true"></i>
                                    @ucfirst(__('app.studios'))
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.genre.index') }}">
                                    <i class="fas fa-list-alt" aria-hidden="true"></i>
                                    @ucfirst(__('app.genres'))
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.serie.index') }}">
                                    <i class="fas fa-stream" aria-hidden="true"></i>
                                    @ucfirst(__('app.series'))
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.game.index') }}">
                                    <i class="fas fa-gamepad" aria-hidden="true"></i>
                                    @ucfirst(__('app.games'))
                                </a>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav  mt-2 mt-md-0">
                        @role('superAdmin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.activity.index') }}">
                                <i class="fas fa-file-signature" aria-hidden="true"></i>
                                @ucfirst(__('app.activity'))
                            </a>
                        </li>
                        @endrole
                        <form action="{{ route('logout') }}" method="POST" class="form-inline" id="logout-form">
                            @csrf
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                                <span class="sr-only">@ucfirst(__('auth.logout'))</span>
                            </a>
                        </form>
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
            
        </main>
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('js')
</body>
</html>
