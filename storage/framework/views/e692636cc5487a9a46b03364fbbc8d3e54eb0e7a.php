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
    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" />
    <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?> " />
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('apple-touch-icon.png')); ?>" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('favicon-16x16.png')); ?>" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon-32x32.png')); ?>" />
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
                            <a class="nav-link" href="<?php echo e(route('admin.index')); ?>">
                                <i class="fas fa-home" aria-hidden="true"></i>
                                <?php echo ucfirst(__('app.admin')); ?>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-podcast" aria-hidden="true"></i>
                                <?php echo ucfirst(__('app.menuPodcasts')); ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <a class="dropdown-item" href="<?php echo e(route('admin.podcast.index')); ?>">
                                    <i class="fas fa-podcast" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.podcastsList')); ?>
                                </a>
                                <?php $__currentLoopData = $menuPodcasts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuPodcast): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="dropdown-item" href="<?php echo e(route('admin.podcast.show', ['uuid' => $menuPodcast->uuid])); ?>">
                                    <i class="fas fa-podcast" aria-hidden="true"></i>
                                    <?php echo e($menuPodcast->name); ?>

                                </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-users" aria-hidden="true"></i>
                                <?php echo ucfirst(__('app.menuContacts')); ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown02">
                                <a class="dropdown-item" href="<?php echo e(route('admin.profession.index')); ?>">
                                    <i class="fas fa-user-tie" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.professions')); ?>
                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('admin.contact.index')); ?>">
                                    <i class="fas fa-address-book" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.contacts')); ?>
                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('admin.source.index')); ?>">
                                    <i class="fas fa-link" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.sources')); ?>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-gamepad" aria-hidden="true"></i>
                                <?php echo ucfirst(__('app.menuGames')); ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown03">
                                <a class="dropdown-item" href="<?php echo e(route('admin.manufacturer.index')); ?>">
                                    <i class="fas fa-industry" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.manufacturers')); ?>
                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('admin.console.index')); ?>">
                                    <i class="fas fa-dice" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.consoles')); ?>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo e(route('admin.studio.index')); ?>">
                                    <i class="fas fa-terminal" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.studios')); ?>
                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('admin.genre.index')); ?>">
                                    <i class="fas fa-list-alt" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.genres')); ?>
                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('admin.serie.index')); ?>">
                                    <i class="fas fa-stream" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.series')); ?>
                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('admin.game.index')); ?>">
                                    <i class="fas fa-gamepad" aria-hidden="true"></i>
                                    <?php echo ucfirst(__('app.games')); ?>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav  mt-2 mt-md-0">
                        <?php if(auth()->check() && auth()->user()->hasRole('superAdmin')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('admin.activity.index')); ?>">
                                <i class="fas fa-file-signature" aria-hidden="true"></i>
                                <?php echo ucfirst(__('app.activity')); ?>
                            </a>
                        </li>
                        <?php endif; ?>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="form-inline" id="logout-form">
                            <?php echo csrf_field(); ?>
                            <a class="nav-link" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                                <span class="sr-only"><?php echo ucfirst(__('auth.logout')); ?></span>
                            </a>
                        </form>
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
            
        </main>
    </div>
</div>
<!-- Scripts -->
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php echo $__env->yieldContent('js'); ?>
</body>
</html>
<?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/layouts/admin.blade.php ENDPATH**/ ?>