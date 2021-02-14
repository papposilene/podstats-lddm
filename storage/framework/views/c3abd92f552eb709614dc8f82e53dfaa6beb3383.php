        <nav class="col-md-2 d-none d-md-block bg-dark sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.index')); ?>">
                            <i class="fas fa-home" aria-hidden="true"></i>
                            <?php echo ucfirst(__('app.admin')); ?>
                        </a>
                    </li>
                    <?php if(auth()->check() && auth()->user()->hasRole('superAdmin')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.activity.index')); ?>">
                            <i class="fas fa-file-medical-alt" aria-hidden="true"></i>
                            <?php echo ucfirst(__('app.activityLog')); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.user.index')); ?>">
                            <i class="fas fa-users" aria-hidden="true"></i>
                            <?php echo ucfirst(__('app.users')); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span><?php echo ucfirst(__('app.menuContacts')); ?></span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.profession.index')); ?>">
                            <i class="fas fa-users-cog" aria-hidden="true"></i>
                            <?php echo ucfirst(__('app.professions')); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.contact.index')); ?>">
                            <i class="fas fa-address-book" aria-hidden="true"></i>
                            <?php echo ucfirst(__('app.contacts')); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.source.index')); ?>">
                            <i class="fas fa-link" aria-hidden="true"></i>
                            <?php echo ucfirst(__('app.links')); ?>
                        </a>
                    </li>
                </ul>
                    
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span><?php echo ucfirst(__('app.menuGames')); ?></span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.manufacturer.index')); ?>">
                            <i class="fas fa-industry" aria-hidden="true"></i>
                            <?php echo ucfirst(__('app.manufacturers')); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.console.index')); ?>">
                            <i class="fas fa-dice" aria-hidden="true"></i>
                            <?php echo ucfirst(__('app.consoles')); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.studio.index')); ?>">
                            <i class="fas fa-terminal" aria-hidden="true"></i>
                            <?php echo ucfirst(__('app.studios')); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.genre.index')); ?>">
                            <i class="fas fa-list-alt" aria-hidden="true"></i>
                            <?php echo ucfirst(__('app.genres')); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.game.index')); ?>">
                            <i class="fas fa-gamepad" aria-hidden="true"></i>
                            <?php echo ucfirst(__('app.games')); ?>
                        </a>
                    </li>
                </ul>
				
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span><?php echo ucfirst(__('app.menuPodcasts')); ?></span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.podcast.index')); ?>">
                            <i class="fas fa-podcast" aria-hidden="true"></i>
                            <?php echo ucfirst(__('app.podcastsList')); ?>
                        </a>
                    </li>
                    <?php $__currentLoopData = $menuPodcasts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuPodcast): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.podcast.show', ['uuid' => $menuPodcast->uuid])); ?>">
                            <i class="fas fa-podcast" aria-hidden="true"></i>
                            <?php echo e($menuPodcast->name); ?>

                        </a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </nav><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>