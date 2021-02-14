<?php $__env->startSection('title', @ucfirst(__('app.podcastStats'))); ?>

<?php $__env->startSection('content'); ?>
<div class="row row-cols-1 row-cols-md-3 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header"><?php echo ucfirst(__('app.podcastStats')); ?></h1>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statEpisodes')); ?></span>
                    <span><?php echo e(count($episodes)); ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statContacts')); ?></span>
                    <span><?php echo e(count($contacts)); ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statGames')); ?></span>
                    <span><?php echo e(count($games)); ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statTracks')); ?></span>
                    <span><?php echo e(count($tracks)); ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statEpisodeAverage')); ?></span>
                    <?php
                    $now = Carbon\Carbon::now();
                    foreach ($durations as $episode)
                    {
                        $time = $episode->duration;
                        $average = $now->average($time);
                    }
                    ?>
                    <span><?php echo ($average)->format('H:i:s'); ?></span>
                </li>
                <a href="<?php echo e(route('public.episode.show', ['uuid' => $durations->first()->uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <?php echo ucfirst(__('app.statEpisodeShort', ['title' => $durations->first()->title])); ?>
                    </span>
                    <span><?php echo ($durations->first()->duration)->format('H:i:s'); ?></span>
                </a>
                <a href="<?php echo e(route('public.episode.show', ['uuid' => $durations->last()->uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>
                        <?php echo ucfirst(__('app.statEpisodeLong', ['title' => $durations->last()->title])); ?>
                    </span>
                    <span><?php echo ($durations->last()->duration)->format('H:i:s'); ?></span>
                </a>
            </ul>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h5 class="card-header"><?php echo ucfirst(__('app.statContinents')); ?></h5>
            <div class="card-body">
                <canvas id="statsContinents" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h5 class="card-header"><?php echo ucfirst(__('app.statGenders')); ?></h5>
            <div class="card-body">
                <canvas id="statsGenders" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h5 class="card-header"><?php echo ucfirst(__('app.statGameTop10Genres')); ?></h5>
            <div class="card-body">
                <canvas id="statsGenres" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h5 class="card-header"><?php echo ucfirst(__('app.statModes')); ?></h5>
            <div class="card-body">
                <canvas id="statsModes" width="100%" height="100%"></canvas>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$.getJSON("<?php echo e(route('api.episode.continents')); ?>", function (json) {
    var pieContinents = document.getElementById('statsContinents').getContext('2d');
    var arrContinents = $.makeArray( json.chart );
    var labels = $.map(arrContinents, function(item) {
        return item.labels;
    });
    var continents = $.map(arrContinents, function(item) {
        return item.data;
    });
    var chartGender = new Chart(pieContinents, {
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
                position: 'right'
            }
        }
    });
});
$.getJSON("<?php echo e(route('api.episode.genders')); ?>", function (json) {
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
                position: 'right'
            }
        }
    });
});
$.getJSON("<?php echo e(route('api.game.genres', ['count' => 10])); ?>", function (json) {
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
$.getJSON("<?php echo e(route('api.game.modes')); ?>", function (json) {
    var pieModes = document.getElementById('statsModes').getContext('2d');
    var arrModes = $.makeArray( json.chart );
    var labels = $.map(arrModes, function(item) {
        return item.labels;
    });
    var modes = $.map(arrModes, function(item) {
        return item.data;
    });
    var chartConsoles = new Chart(pieModes, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [
                {
                    data: modes,
                    borderColor: '#000',
                    backgroundColor: [
                        '#f66d9b',
                        '#6cb2eb',
                        '#cc65fe',
                        '#ffce56'
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
$.getJSON("<?php echo e(route('api.episode.months')); ?>", function (json) {
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/statistics/episode.blade.php ENDPATH**/ ?>