<?php $__env->startSection('title', @ucfirst(__('app.statContact'))); ?>

<?php $__env->startSection('content'); ?>
<div class="row row-cols-1 row-cols-md-3 mt-2">
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header"><?php echo ucfirst(__('app.statContact')); ?></h1>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statContactTotal')); ?></span>
                    <span><?php echo e(count($contacts)); ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statContactDead')); ?></span>
                    <span><?php echo e(count($contacts->whereNotNull('died_at'))); ?></span>
                </li>
                <a href="<?php echo e(route('public.contact.index', ['gender' => 'band'])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statContactGenderB')); ?></span>
                    <span><?php echo e(count($contacts->whereStrict('gender', 'band'))); ?></span>
                </a>
                <a href="<?php echo e(route('public.contact.index', ['gender' => 'feminine'])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statContactGenderF')); ?></span>
                    <span><?php echo e(count($contacts->whereStrict('gender', 'feminine'))); ?></span>
                </a>
                <a href="<?php echo e(route('public.contact.index', ['gender' => 'masculine'])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statContactGenderM')); ?></span>
                    <span><?php echo e(count($contacts->whereStrict('gender', 'masculine'))); ?></span>
                </a>
                <a href="<?php echo e(route('public.contact.index', ['gender' => 'neutral'])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span><?php echo ucfirst(__('app.statContactGenderN')); ?></span>
                    <span><?php echo e(count($contacts->whereStrict('gender', 'neutral'))); ?></span>
                </a>
            </ul>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card">
            <h1 class="h5 card-header"><?php echo ucfirst(__('app.statUnknown')); ?></h1>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#modaGenderList">
                    <span><?php echo ucfirst(__('app.statContactGenderUnknown')); ?></span>
                    <span><?php echo e(count($contacts->where('gender', 'unknown'))); ?></span>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#modalLivesAtList">
                    <span><?php echo ucfirst(__('app.statContactLivesAtUnknown')); ?></span>
                    <span><?php echo e(count($contacts->whereNull('lives_at'))); ?></span>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#modalBirthOnList">
                    <span><?php echo ucfirst(__('app.statContactBornOnUnknown')); ?></span>
                    <span><?php echo e(count($contacts->whereNull('born_on'))); ?></span>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#modalBirthAtList">
                    <span><?php echo ucfirst(__('app.statContactBornAtUnknown')); ?></span>
                    <span><?php echo e(count($contacts->whereNull('born_at'))); ?></span>
                </a>
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
            <h1 class="h5 card-header"><?php echo ucfirst(__('app.statContactTop20')); ?></h1>
            <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $top20; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eachOne): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item">
                    <span>
                        #<?php echo e($loop->iteration); ?>.
                        <strong><a href="<?php echo e(route('public.contact.show', ['uuid' => $eachOne->contact_uuid])); ?>"><?php echo e($eachOne->hasContact->uname); ?></a></strong>,
                        <?php echo e(__('app.statContactDone', ['count' => $episodes->where('contact_uuid', $eachOne->contact_uuid)->count()])); ?>

                    </span>
                    <ol class="list-inline text-secondary">
                        <?php $__currentLoopData = $episodes->sortByDesc('id')->where('contact_uuid', $eachOne->contact_uuid); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eachEpisode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-inline-item">
                            #<?php echo e($eachEpisode->hasEpisode->id); ?>.
                            <a href="<?php echo e(route('public.episode.show', ['uuid' => $eachEpisode->episode_uuid])); ?>" class="text-secondary"><?php echo e($eachEpisode->hasEpisode->title); ?></a>
                            (<?php echo ($eachEpisode->hasEpisode->aired_on)->format('Y'); ?>)
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>

<div class="modal fade" id="modaGenderList" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modaGenderListTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaGenderListTitle">
                    <?php echo ucfirst(__('app.statContactGenderUnknown')); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush mb-3">
                    <?php $__currentLoopData = $contacts->where('gender', 'unknown'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genderlessContact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('public.contact.show', ['uuid' => $genderlessContact->uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span><?php echo e($genderlessContact->uname); ?></span>
                        <span class="badge badge-primary badge-pill">></span>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalLivesAtList" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalLivesAtListTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLivesAtListTitle">
                    <?php echo ucfirst(__('app.statContactLivesAtUnknown')); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush mb-3">
                    <?php $__currentLoopData = $contacts->whereNull('lives_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $livesAtContact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('public.contact.show', ['uuid' => $livesAtContact->uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span><?php echo e($livesAtContact->uname); ?></span>
                        <span class="badge badge-primary badge-pill">></span>
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
<div class="modal fade" id="modalBirthOnList" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalBirthOnListTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBirthOnListTitle">
                    <?php echo ucfirst(__('app.statContactBornOnUnknown')); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush mb-3">
                    <?php $__currentLoopData = $contacts->whereNull('born_on'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bornAtContact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('public.contact.show', ['uuid' => $bornAtContact->uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span><?php echo e($bornAtContact->uname); ?></span>
                        <span class="badge badge-primary badge-pill">></span>
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
<div class="modal fade" id="modalBirthAtList" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalBirthAtListTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBirthAtListTitle">
                    <?php echo ucfirst(__('app.statContactBornAtUnknown')); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush mb-3">
                    <?php $__currentLoopData = $contacts->whereNull('born_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bornAtContact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('public.contact.show', ['uuid' => $bornAtContact->uuid])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span><?php echo e($bornAtContact->uname); ?></span>
                        <span class="badge badge-primary badge-pill">></span>
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
$.getJSON("<?php echo e(route('api.contact.genders')); ?>", function (json) {
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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/public/statistics/contact.blade.php ENDPATH**/ ?>