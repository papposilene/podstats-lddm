<div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center pt-2 mb-2 mt-3">
    <ul class="list-inline float-right text-muted">
        <!-- li class="list-inline-item">
            <a href="<?php echo e(route('public.about')); ?>" class="text-muted">
                <?php echo ucfirst(__('app.footerAbout', ['name' => config('app.name', 'Laravel')])); ?>
            </a>
        </li -->
        <li class="list-inline-item">
            <a href="<?php echo e(route('public.api')); ?>" class="text-muted">
                <?php echo ucfirst(__('app.footerAPI')); ?>
            </a>
        </li>
        <li class="list-inline-item">
            <?php echo ucfirst(__('app.footerCreatedBy', ['name' => '<a href="https://papposilene.com" class="text-muted" target="_blank" rel="noopener">Philippe-Alexandre Pierre</a>'])); ?>
        </li>
    </ul>
</div><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/layouts/footer.blade.php ENDPATH**/ ?>