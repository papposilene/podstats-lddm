<?php $__env->startSection('title', @ucfirst(__('app.gameCreate'))); ?>

<?php $__env->startSection('content'); ?>            
<div class="row">
    <div class="col-8">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
            <h1 class="h2 text-white">
                <?php echo ucfirst(__('app.gameCreate')); ?>
            </h1>
        </div>

        <form method="POST" action="<?php echo e(route('admin.game.store')); ?>" class="needs-validation" novalidate />
            <?php echo csrf_field(); ?>
            <div class="form-row mt-2">
                <div class="col">
                    <h3 class="h4"><?php echo ucfirst(__('app.gameInformations')); ?></h3>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary border border-primary text-white" id="form_title">
                        <i class="fas fa-gamepad" aria-hidden="true" title="<?php echo ucfirst(__('app.gameTitle')); ?>"></i>
                    </span>
                </div>
                <input type="text" class="form-control border border-primary" name="game_title" placeholder="<?php echo ucfirst(__('app.gameTitle')); ?>" aria-label="<?php echo ucfirst(__('app.gameTitle')); ?>" aria-describedby="form_title" required />
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary border border-secondary text-white" id="form_date">
                        &nbsp;<i class="fas fa-calendar-check" aria-hidden="true" title="<?php echo ucfirst(__('app.gameDate')); ?>"></i>
                    </span>
                </div>
                <input type="text" class="form-control border border-primary" name="game_releasedOn" placeholder="<?php echo e(__('app.ddmmyy')); ?>" aria-label="<?php echo ucfirst(__('app.gameDate')); ?>" aria-describedby="form_date" required />
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary border border-secondary text-white" id="form_mode">
                        &nbsp;<i class="fas fa-list-ol" aria-hidden="true" title="<?php echo ucfirst(__('app.gameGenre')); ?>"></i>
                    </span>
                </div>
                <select multiple class="form-control border border-primary" name="modes[]" aria-label="<?php echo ucfirst(__('app.gameMode')); ?>" aria-describedby="form_mode" required />
                    <option value="single"><?php echo ucfirst(__('app.gameSingle')); ?></option>
                    <option value="multi"><?php echo ucfirst(__('app.gameMulti')); ?></option>
                    <option value="cooperative"><?php echo ucfirst(__('app.gameCooperative')); ?></option>
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary border border-primary text-white" id="form_genre">
                        &nbsp;<i class="fas fa-list-ul" aria-hidden="true" title="<?php echo ucfirst(__('app.gameMode')); ?>"></i>
                    </span>
                </div>
                <select multiple class="form-control border border-primary" name="genres[]" size="10" aria-label="<?php echo ucfirst(__('app.gameMode')); ?>" aria-describedby="form_genre" required />
                    <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($genre->uuid); ?>"><?php echo e($genre->genre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-row mt-2">
                <div class="col">
                    <h3 class="h4"><?php echo ucfirst(__('app.studiosList')); ?></h3>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary border border-primary text-white" id="form_studio">
                        &nbsp;<i class="fas fa-terminal" aria-hidden="true"></i>
                    </span>
                </div>
                <input type="text" class="form-control border border-primary" id="studio_name" name="studio_name" placeholder="<?php echo ucfirst(__('app.studio')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.studio')); ?>" required />
            </div>
            <div class="form-row mt-2">
                <div class="col">
                    <h3 class="h4"><?php echo ucfirst(__('app.consolesList')); ?></h3>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary border border-primary text-white" id="form_consoles">
                        &nbsp;<i class="fas fa-dice" aria-hidden="true"></i>
                    </span>
                </div>
                <select multiple class="form-control border border-primary" name="consoles[]" size="10" aria-label="<?php echo ucfirst(__('app.console')); ?>" aria-describedby="form_consoles" required />
                    <?php $__currentLoopData = $consoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $console): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($console->uuid); ?>"><?php echo e($console->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <input type="hidden" name="studio_uuid" id="studio_uuid" value="" />
            <button type="submit" class="btn btn-primary mt-3 float-right"><?php echo ucfirst(__('app.gameStore')); ?></button>
        </form>
    </div>

    <div class="col-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
            <h2 class="h2 text-white">
                <i class="fas fa-list-ol" aria-hidden="true"></i>
                <?php echo ucfirst(__('app.dataLast')); ?>
            </h2>
        </div>
        <div class="list-group list-group-flush">
            <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('admin.game.show', ['uuid' => $game->uuid])); ?>" class="list-group-item list-group-item-action">
                <?php echo e($game->title); ?> <?php if($game->released_on): ?>(<?php echo ($game->released_on)->format('Y'); ?>)<?php endif; ?>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$(function() {
    $("#studio_name").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.studio.autocomplete', ['q']); ?>=" + request.term, function (data) {
                if(!data.length){
                    var result = [{
                        label: '<?php echo ucfirst(__('app.searchNotFound')); ?>',
                        value: response.term
                    }];
                    response(result);
                }
                else
                {
                    response($.map(data, function (value, key) {
                        return {
                            uuid: value.uuid,
                            label: value.studio,
                            value: value.studio
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#studio_uuid").val(ui.item.uuid);
		}
	});
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/game/create.blade.php ENDPATH**/ ?>