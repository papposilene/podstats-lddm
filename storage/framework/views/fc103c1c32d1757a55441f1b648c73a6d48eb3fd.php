<?php $__env->startSection('title', $contact->uname); ?>

<?php $__env->startSection('content'); ?>
<div class="card mb-3 mt-2">
    <div class="row">
        <div class="col">
            <div class="card-body">
                <h1 class="card-title text-center"><?php echo e($contact->uname); ?></h1>
                <p class="card-text">
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            <?php if($contact->fname): ?>
                            <?php echo e($contact->fname); ?>

                            <?php endif; ?>
                            <?php if($contact->mname): ?>
                            <?php echo e($contact->mname); ?>

                            <?php endif; ?>
                            <?php if($contact->lname): ?>
                            <?php echo e($contact->lname); ?>

                            <?php endif; ?>
                        </li>
                    </ol>
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            <?php if($contact->gender === 'band'): ?>
                            <i class="fas fa-users" title="<?php echo ucfirst(__('app.band')); ?>" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.band')); ?>"></i>
                            <?php elseif($contact->gender === 'feminine'): ?>
                            <i class="fas fa-venus" title="<?php echo ucfirst(__('app.feminine')); ?>" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.feminine')); ?>"></i>
                            <?php elseif($contact->gender === 'masculine'): ?>
                            <i class="fas fa-mars" title="<?php echo ucfirst(__('app.masculine')); ?>" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.masculine')); ?>"></i>
                            <?php elseif($contact->gender === 'neutral'): ?>
                            <i class="fas fa-transgender-alt" title="<?php echo ucfirst(__('app.neutral')); ?>" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.neutral')); ?>"></i>
                            <?php else: ?>
                            <i class="fas fa-genderless" title="<?php echo ucfirst(__('app.unknown')); ?>" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.unknown')); ?>"></i>
                            <?php endif; ?>
                        </li>
                        <li class="list-inline-item">
                            <?php if($contact->livesAt): ?>
                            <?php echo e($contact->livesAt->flag); ?> <?php echo e($contact->livesAt->name_eng_common); ?>

                            <?php else: ?>
                            <?php echo ucfirst(__('app.contactLivesAtUnknown')); ?>
                            <?php endif; ?>
                        </li>
                    </ol>
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            <?php if($contact->born_on): ?>
                            <?php echo ($contact->born_on)->format('d/m/Y'); ?>
                            <?php if($contact->bornAt): ?> @ <?php echo e($contact->bornAt->name_eng_common); ?>. <?php else: ?> @ <?php echo ucfirst(__('app.contactBornAtUnknown')); ?>. <?php endif; ?>
                            <?php endif; ?>
                        </li>
                        <li class="list-inline-item">
                            <?php if($contact->died_on): ?>
                            <?php echo ($contact->died_on)->format('d/m/Y'); ?>
                            <?php if($contact->diedAt): ?> @ <?php echo e($contact->diedAt->name_eng_common); ?>. <?php else: ?> @ <?php echo ucfirst(__('app.contactDiedAtUnknown')); ?>. <?php endif; ?>
                            <?php endif; ?>
                        </li>
                    </ol>
                </p>
                <p class="card-text text-center">
                    <small class="text-muted"><?php echo e(__('app.updatedAt')); ?> <?php echo ($contact->updated_at)->format('d/m/Y @ H:i'); ?></small>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header"><?php echo ucfirst(__('app.statGameTop10Studios')); ?></h3>
            <div class="card-body">
                <canvas id="statsStudios" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header"><?php echo ucfirst(__('app.statGameTop10Consoles')); ?></h3>
            <div class="card-body">
                <canvas id="statsConsoles" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header"><?php echo ucfirst(__('app.statGameTop10Genres')); ?></h3>
            <div class="card-body">
                <canvas id="statsGenres" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-1">
    <?php if(count($contact->hasTracks) > 0): ?>
    <div class="col mb-4">
        <div class="card">
            <h2 class="h5 card-header"><?php echo ucfirst(__('app.tracksList')); ?></h2>
            <div class="list-group list-group-flush">
                <?php $__currentLoopData = $contact->hasTracks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('public.episode.show', ['uuid' => $track->track_uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <?php echo e($track->inEpisode->hasEpisode->id); ?>. <strong><?php echo e($track->inEpisode->hasEpisode->title); ?></strong>, <?php echo ($track->inEpisode->hasEpisode->aired_on)->format('d/m/Y'); ?>.<br />
                        <?php echo e($track->composedFor->title); ?>, <em><?php echo e($track->hasComposed->title); ?></em>, <?php if($track->composedFor->released_on): ?> <?php echo ($track->composedFor->released_on)->format('Y'); ?><?php endif; ?>.<br />
                        <em>
                            <?php if($track->composedFor->studio_uuid): ?>
                            <?php echo e($track->composedFor->createdBy->locatedAt->flag); ?> <?php echo e($track->composedFor->createdBy->studio); ?>.
                            <?php else: ?>
                            <?php echo ucfirst(__('app.studioUnknown')); ?>.
                            <?php endif; ?>
                        </em>
                    </span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(count($contact->hasLinks) > 0): ?>
    <div class="col">
        <div class="card">
            <h2 class="h5 card-header"><?php echo ucfirst(__('app.sourcesList')); ?></h2>
            <div class="list-group list-group-flush">
                <?php $__currentLoopData = $contact->hasLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($source->data); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <i class="<?php echo e($source->info->icon); ?>" aria-hidden="true" title="<?php echo ucfirst(__('app.' . $source->type)); ?>"></i>
                        <?php echo ucfirst(__('app.' . $source->type)); ?>
                    </span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$.getJSON("<?php echo e(route('api.contact.studios', ['uuid' => $contact->uuid, 'count' => 10])); ?>", function (json) {
    var pieStudios = document.getElementById('statsStudios').getContext('2d');
    var arrStudios = $.makeArray( json.chart );
    var labels = $.map(arrStudios, function(item) {
        return item.labels;
    });
    var studios = $.map(arrStudios, function(item) {
        return item.data;
    });
    var chartStudios = new Chart(pieStudios, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: studios,
                    borderColor: '#000',
                    backgroundColor: [
                        '#b11312',
                        '#3490dc',
                        '#ffed4a',
                        '#38c172',
                        '#dc3545',
                        '#6cb2eb',
                        '#f6993f',
                        '#6574cd',
                        '#4dc0b5',
                        '#9561e2',
                        '#f66d9b'
                    ]
                }
            ]
        },
        options: {
            title: {
                display: false
            },
            label: {
                fontColor: '#fff'
            },
            legend: {
                align: 'start',
                display: true,
                position: 'bottom'
            }
        }
    });
});
$.getJSON("<?php echo e(route('api.contact.consoles', ['uuid' => $contact->uuid, 'count' => 10])); ?>", function (json) {
    var pieConsoles = document.getElementById('statsConsoles').getContext('2d');
    var arrConsoles = $.makeArray( json.chart );
    var labels = $.map(arrConsoles, function(item) {
        return item.labels;
    });
    var consoles = $.map(arrConsoles, function(item) {
        return item.data;
    });
    var chartConsoles = new Chart(pieConsoles, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: consoles,
                    borderColor: '#000',
                    backgroundColor: [
                        '#b11312',
                        '#3490dc',
                        '#ffed4a',
                        '#38c172',
                        '#dc3545',
                        '#6cb2eb',
                        '#f6993f',
                        '#6574cd',
                        '#4dc0b5',
                        '#9561e2',
                        '#f66d9b'
                    ]
                }
            ]
        },
        options: {
            title: {
                display: false
            },
            label: {
                fontColor: '#fff'
            },
            legend: {
                align: 'start',
                display: true,
                position: 'bottom'
            }
        }
    });
});
$.getJSON("<?php echo e(route('api.contact.genres', ['uuid' => $contact->uuid, 'count' => 10])); ?>", function (json) {
    var pieGenres = document.getElementById('statsGenres').getContext('2d');
    var arrGenres = $.makeArray( json.chart );
    var labels = $.map(arrGenres, function(item) {
        return item.labels;
    });
    var genres = $.map(arrGenres, function(item) {
        return item.data;
    });
    var chartGenres = new Chart(pieGenres, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: genres,
                    borderColor: '#000',
                    backgroundColor: [
                        '#b11312',
                        '#3490dc',
                        '#ffed4a',
                        '#38c172',
                        '#dc3545',
                        '#6cb2eb',
                        '#f6993f',
                        '#6574cd',
                        '#4dc0b5',
                        '#9561e2',
                        '#f66d9b'
                    ]
                }
            ]
        },
        options: {
            title: {
                display: false
            },
            label: {
                fontColor: '#fff'
            },
            legend: {
                align: 'start',
                display: true,
                position: 'bottom'
            }
        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/contact/show.blade.php ENDPATH**/ ?>