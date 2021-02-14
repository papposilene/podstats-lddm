<?php $__env->startSection('title', $episode->title); ?>

<?php $__env->startSection('content'); ?>
<div class="card mb-3 mt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card-body">
                <h2 class="h4 text-center"><a href="<?php echo e(route('public.podcast.show', ['uuid' => $episode->inPodcast->uuid])); ?>" class="text-white"><em><?php echo e($episode->inPodcast->name); ?></em></a></h2>
                <h1 class="card-title text-center"><?php echo e($episode->title); ?></h1>
                <p class="card-text">
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            <i class="fas fa-list-ol" aria-hidden="true"></i>
                            <?php echo ucfirst(__('app.seasonNb', ['season' => $episode->season])); ?>
                        </li>
                        <li class="list-inline-item">
                            <i class="fas fa-hashtag" aria-hidden="true"></i>
                            <?php echo ucfirst(__('app.episodeNb', ['episode' => $episode->id])); ?>
                        </li>
                    </ol>
                    <ol class="list-inline text-center">
                        <li class="list-inline-item">
                            <i class="fas fa-calendar-check" aria-hidden="true"></i>
                            <?php if($episode->aired_on): ?>
                            <?php echo ($episode->aired_on)->format('d/m/Y'); ?>
                            <?php else: ?>
                            00/00/0000
                            <?php endif; ?>
                        </li>
                        <li class="list-inline-item">
                            <i class="fas fa-clock" aria-hidden="true"></i> 
                            <?php if($episode->duration): ?>
                            <?php echo ($episode->duration)->format('H:i:s'); ?>
                            <?php else: ?>
                            00:00:00
                            <?php endif; ?>
                        </li>
                        <li class="list-inline-item">
                            <i class="fas fa-link" aria-hidden="true"></i> 
                            <?php if($episode->hasSource): ?>
                            <a href="<?php echo e($episode->hasSource->data); ?>" class="text-white" target="_blank" rel="noopener">
                                <?php echo ucfirst(__('app.podcastSource')); ?>
                            </a>
                            <?php else: ?>
                            ---
                            <?php endif; ?>
                        </li>
                    </ol>
                </p>
                <p class="card-text text-center">
                    <small class="text-muted"><?php echo e(__('app.updatedAt')); ?> <?php echo ($episode->updated_at)->format('d/m/Y @ H:i'); ?></small>
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <p class="p-4 text-justify">
                <?php echo e($episode->description); ?>

            </p>
        </div>
    </div>
</div>
                
<div class="row row-cols-1 row-cols-md-1">
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header"><?php echo ucfirst(__('app.statistics')); ?></h3>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#modalContactsList">
                    <span><?php echo ucfirst(__('app.statEpisodeContacts')); ?></span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($episode->hasContacts)); ?></span>
                </a>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statEpisodeTracks')); ?></span>
                    <span class="badge badge-primary badge-pill"><?php echo e(count($episode->hasTracklist)); ?></span>
                </div>
                <a href="<?php echo e(route('public.stats.episodes')); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.podcastStats')); ?></span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
                <a href="<?php echo e(route('public.stats.seasons', ['season' => $episode->season])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.seasonStats', ['season' => $episode->season])); ?></span>
                    <span class="badge badge-primary badge-pill">></span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3">
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header"><?php echo ucfirst(__('app.statGameTop10Genres')); ?></h3>
            <div class="card-body">
                <canvas id="statsGenres" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header"><?php echo ucfirst(__('app.statContinents')); ?></h3>
            <div class="card-body">
                <canvas id="statsContinents" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h3 class="h5 card-header"><?php echo ucfirst(__('app.statGenders')); ?></h3>
            <div class="card-body">
                <canvas id="statsGenders" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row row-cols-1 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header"><?php echo ucfirst(__('app.monthsStats')); ?></h1>
            <div class="card-body">
                <canvas id="statsMonths" width="100%" height="33%"></canvas>
            </div>
        </div>
    </div>
</div>
    
<div class="card">
    <h2 class="h4 card-header"><?php echo ucfirst(__('app.trackList')); ?></h2>
    <div class="list-group list-group-flush">
        <?php $__currentLoopData = $episode->hasTracklist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('public.track.show', ['uuid' => $track->track_uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <span>
                <?php echo e($track->track_id); ?>. <strong><?php echo e($track->hasTrack->title); ?></strong>.<br />
                <?php if($track->hasGame->createdBy): ?>
                <?php echo e($track->hasGame->createdBy->locatedAt->flag); ?> <?php echo e($track->hasGame->createdBy->studio); ?>, <em><?php echo e($track->hasGame->title); ?></em>, <?php if($track->hasGame->released_on): ?> <?php echo ($track->hasGame->released_on)->format('Y'); ?><?php endif; ?>.
                <?php endif; ?>
            </span>
            <span class="badge badge-secondary badge-pill"><?php echo ucfirst(__('app.trackType' . ucfirst($track->track_type))); ?></span>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<div class="modal fade" id="modalContactsList" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalContactsListTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalContactsListTitle">
                    <?php echo ucfirst(__('app.contactsList')); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush mb-3">
                    <?php $__currentLoopData = $episode->hasContacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('public.contact.show', ['uuid' => $staff->contact_uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span>
                            <?php echo e($staff->hasContact->uname); ?></br />
                            <em>
                                <?php if($staff->hasContact->livesAt): ?> <?php echo e($staff->hasContact->livesAt->flag); ?> <?php echo e($staff->hasContact->livesAt->name_eng_common); ?>. <?php else: ?> <?php echo ucfirst(__('app.contactLivesAtUnknown')); ?>. <?php endif; ?>
                                <?php echo ucfirst($staff->hasProfession->profession); ?>.
                            </em>
                        </span>
                        <span class="float-right">
                            <?php if($staff->hasContact->gender === 'band'): ?>
                            <i class="fas fa-users" title="<?php echo ucfirst(__('app.band')); ?>" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.band')); ?>"></i>
                            <?php elseif($staff->hasContact->gender === 'feminine'): ?>
                            <i class="fas fa-venus" title="<?php echo ucfirst(__('app.feminine')); ?>" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.feminine')); ?>"></i>
                            <?php elseif($staff->hasContact->gender === 'masculine'): ?>
                            <i class="fas fa-mars" title="<?php echo ucfirst(__('app.masculine')); ?>" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.masculine')); ?>"></i>
                            <?php elseif($staff->hasContact->gender === 'neutral'): ?>
                            <i class="fas fa-transgender-alt" title="<?php echo ucfirst(__('app.neutral')); ?>" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.neutral')); ?>"></i>
                            <?php else: ?>
                            <i class="fas fa-genderless" title="<?php echo ucfirst(__('app.unknown')); ?>" aria-hidden="true" aria-label="<?php echo ucfirst(__('app.unknown')); ?>"></i>
                            <?php endif; ?>
                        </span>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$.getJSON("<?php echo route('api.episode.genres', ['eid' => $episode->id, 'count' => 10]); ?>", function (json) {
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
$.getJSON("<?php echo e(route('api.episode.continents', ['eid' => $episode->id])); ?>", function (json) {
    var pieContinents = document.getElementById('statsContinents').getContext('2d');
    var arrContinents = $.makeArray( json.chart );
    var labels = $.map(arrContinents, function(item) {
        return item.labels;
    });
    var continents = $.map(arrContinents, function(item) {
        return item.data;
    });
    var chartContinents = new Chart(pieContinents, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: continents,
                    borderColor: '#000',
                    backgroundColor: [
                        '#000', // Africa
                        '#dc3545', // Americas
                        '#fff', // Antartic
                        '#ffed4a', // Asia
                        '#3490dc', // Europa
                        '#38c172', // Oceania
                        '#adb5bd' // Unknown
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
$.getJSON("<?php echo e(route('api.episode.genders', ['eid' => $episode->id])); ?>", function (json) {
    var pieGenders = document.getElementById('statsGenders').getContext('2d');
    var arrGenders = $.makeArray( json.chart );
    var labels = $.map(arrGenders, function(item) {
        return item.labels;
    });
    var genders = $.map(arrGenders, function(item) {
        return item.data;
    });
    var chartGender = new Chart(pieGenders, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: genders,
                    borderColor: '#000',
                    backgroundColor: [
                        '#ffce56',
                        '#f66d9b',
                        '#6cb2eb',
                        '#cc65fe',
                        '#adb5bd'
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
$.getJSON("<?php echo e(route('api.episode.months', ['eid' => $episode->id])); ?>", function (json) {
    var pieMonths = document.getElementById('statsMonths').getContext('2d');
    var labMonths = $.makeArray( json.chart.labels );
    var births = $.makeArray( json.chart.datasets[0].data );
    var deaths = $.makeArray( json.chart.datasets[1].data );
    var games = $.makeArray( json.chart.datasets[2].data );
    var chartMonths = new Chart(pieMonths, {
        type: 'bar',
        data: {
            labels: labMonths,
            datasets: [{
                    label: '<?php echo ucfirst(__('app.birthsByMonth')); ?>',
                    backgroundColor: '#adb5bd',
                    borderColor: '#000',
                    data: births
                },
                {
                    label: '<?php echo ucfirst(__('app.gamesByMonth')); ?>',
                    backgroundColor: '#6c757d',
                    borderColor: '#000',
                    data: games
                },
                {
                    label: '<?php echo ucfirst(__('app.deathsByMonth')); ?>',
                    backgroundColor: '#495057',
                    borderColor: '#000',
                    data: deaths
                }]
        },
        options: {
            responsive: true,
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
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/episode/show.blade.php ENDPATH**/ ?>