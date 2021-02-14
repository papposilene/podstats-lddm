<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e(config('app.name', 'Laravel')); ?></title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
    <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?> " />
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('apple-touch-icon.png')); ?>" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('favicon-16x16.png')); ?>" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon-32x32.png')); ?>" />
    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
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
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    <?php echo e(config('app.name', 'Laravel')); ?>

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('public.podcast.show', ['uuid' => $lddm->uuid])); ?>">
                                <i class="fas fa-podcast" aria-hidden="true"></i>
                                <?php echo e($lddm->name); ?>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('public.contact.index')); ?>">
                                <i class="fas fa-address-book" aria-hidden="true"></i>
                                <?php echo ucfirst(__('app.contacts')); ?>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-podcast" aria-hidden="true"></i>
                                <?php echo ucfirst(__('app.menuConsoles')); ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <a class="dropdown-item" href="<?php echo e(route('public.manufacturer.index')); ?>">
                                    <i class="fas fa-industry" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.manufacturers')); ?>
                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('public.console.index')); ?>">
                                    <i class="fas fa-dice" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.consoles')); ?>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-gamepad" aria-hidden="true"></i>
                                <?php echo ucfirst(__('app.menuGames')); ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown02">
                                <a class="dropdown-item" href="<?php echo e(route('public.studio.index')); ?>">
                                    <i class="fas fa-terminal" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.studios')); ?>
                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('public.genre.index')); ?>">
                                    <i class="fas fa-list-alt" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.genres')); ?>
                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('public.game.index')); ?>">
                                    <i class="fas fa-gamepad" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.games')); ?>
                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('public.track.index')); ?>">
                                    <i class="fas fa-music" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.tracks')); ?>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-chart-bar" aria-hidden="true"></i>
                                <?php echo ucfirst(__('app.menuStatistics')); ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown03">
                                <a class="dropdown-item" href="<?php echo e(route('public.stats.episodes')); ?>">
                                    <i class="fas fa-chart-bar" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.podcastStats')); ?>
                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('public.stats.seasons')); ?>">
                                    <i class="fas fa-chart-bar" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.seasonsStats')); ?>
                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('public.stats.countries')); ?>">
                                    <i class="fas fa-chart-bar" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.countriesStats')); ?>
                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('public.stats.contacts')); ?>">
                                    <i class="fas fa-chart-bar" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.contactsStats')); ?>
                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('public.stats.studios')); ?>">
                                    <i class="fas fa-chart-bar" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.studiosStats')); ?>
                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('public.stats.games')); ?>">
                                    <i class="fas fa-chart-bar" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.gamesStats')); ?>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav  mt-2 mt-md-0">
                        <?php if(auth()->guard()->guest()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>">
                                <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
                                <span class="sr-only"><?php echo ucfirst(__('auth.login')); ?></span>
                            </a>
                        </li>
                        <?php if(Route::has('register')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('register')); ?>">
                                <i class="fas fa-user-plus" aria-hidden="true"></i>
                                <?php echo ucfirst(__('auth.register')); ?>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('admin.index')); ?>">
                                <i class="fas fa-tools" aria-hidden="true"></i>
                                <?php echo ucfirst(__('app.admin')); ?>
                            </a>
                        </li>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="form-inline" id="logout-form">
                            <?php echo csrf_field(); ?>
                            <a class="nav-link" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                                <span class="sr-only"><?php echo ucfirst(__('auth.logout')); ?></span>
                            </a>
                        </form>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
            
            <?php if($errors->any()): ?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4">
                <div class="col alert alert-danger">
                    <ol>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="text-danger"><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                </div>
            </div>
            <?php endif; ?>
        
            <?php echo $__env->yieldContent('content'); ?>
            
            <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </main>
    </div>
</div>
    
<!-- Scripts -->
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php echo $__env->yieldContent('js'); ?>
</body>
</html>
<?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/layouts/app.blade.php ENDPATH**/ ?>