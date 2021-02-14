<?php $__env->startSection('title', @ucfirst(__('app.contactsList'))); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-white">
        <i class="fas fa-address-book" aria-hidden="true"></i>
        <?php echo ucfirst(__('app.contactsList')); ?>
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create')): ?>
        <div class="btn-group mr-2">
            <a href="<?php echo e(route('admin.contact.create')); ?>" class="btn btn-sm btn-primary">
                <i class="fas fa-plus" aria-hidden="true" title="<?php echo ucfirst(__('app.contactCreate')); ?>"></i>
                <span class="sr-only"><?php echo ucfirst(__('app.contactCreate')); ?></span>
            </a>
        </div>
        <?php endif; ?>
        <form action="<?php echo e(route('admin.contact.index')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="input-group input-group-sm">
                <input type="text" class="form-control bg-dark border border-secondary text-white" name="q" placeholder="<?php echo ucfirst(__('app.search')); ?>" aria-label="<?php echo ucfirst(__('app.search')); ?>">
                <div class="input-group-append">
                    <button type="submit" class="bg-dark border border-secondary btn-sm text-white">
                        <i class="fas fa-search" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.search')); ?>"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php echo e($contacts->links()); ?>


<div class="table-responsive">
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center"><?php echo ucfirst(__('app.uname')); ?></th>
                <th class="text-center">
                    <?php echo ucfirst(__('app.lname')); ?>
                    <span class="badge badge-pill badge-info float-right">
                        <i class="fas fa-angle-down" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.orderByAsc')); ?>"></i>
                    </span>
                </th>
                <th class="text-center"><?php echo ucfirst(__('app.fname')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.livesAt')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.gender')); ?></th>
                <th class="text-center"><?php echo ucfirst(__('app.actions')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-center"><?php echo e($loop->iteration); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.contact.show', ['uuid' => $contact->uuid])); ?>" class="text-white">
                        <?php echo e($contact->uname); ?>

                    </a>
                </td>
                <td><?php echo e($contact->lname); ?></td>
                <td><?php echo e($contact->fname); ?></td>
                <td>
                <?php if($contact->livesAt): ?>
                        <?php echo e($contact->livesAt->flag); ?>

                    <?php echo e($contact->livesAt->name_eng_common); ?>

                    <?php else: ?>
                    ------
                    <?php endif; ?>
                </td>
                <td class="text-center">
                    <?php if($contact->gender === 'band'): ?>
                    <i class="fas fa-users" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.band')); ?>"></i>
                    <?php elseif($contact->gender === 'feminine'): ?>
                    <i class="fas fa-venus" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.feminine')); ?>"></i>
                    <?php elseif($contact->gender === 'masculine'): ?>
                    <i class="fas fa-mars" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.masculine')); ?>"></i>
                    <?php elseif($contact->gender === 'neutral'): ?>
                    <i class="fas fa-transgender-alt" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.neutral')); ?>"></i>
                    <?php else: ?>
                    <i class="fas fa-genderless" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.neutral')); ?>"></i>
                    <?php endif; ?>
                </td>
                <td class="text-center">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                    <form method="POST" action="<?php echo e(route('admin.contact.delete')); ?>" class="">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="contact_uuid" value ="<?php echo e($contact->uuid); ?>" />
                        <?php endif; ?>
                        <a href="<?php echo e(route('admin.contact.show', ['uuid' => $contact->uuid])); ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-search"></i>
                        </a>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update')): ?>
                        <a href="<?php echo e(route('admin.contact.edit', ['uuid' => $contact->uuid])); ?>" class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i>
                        </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete')): ?>
                        <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<?php echo e($contacts->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/contact/admin.blade.php ENDPATH**/ ?>