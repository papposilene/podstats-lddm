<?php $__env->startSection('title', @ucfirst(__('app.gameEdit', ['game' => $game->title]))); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <?php if($errors->any()): ?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                <div class="col alert alert-danger">
                    <ol>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="text-danger"><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="row">
                <div class="col-8">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
                        <h1 class="h2 text-white">
                            <i class="fas fa-gamepad" aria-hidden="true"></i>
                            <?php echo ucfirst(__('app.gameEdit', ['game' => $game->title])); ?>
                        </h1>
                    </div>
        
                    <form method="POST" action="<?php echo e(route('admin.game.update')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="game_uuid" value="<?php echo e($game->uuid); ?>" />
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
                            <input type="text" class="form-control border border-primary" name="game_title" value="<?php echo e($game->title); ?>" placeholder="<?php echo ucfirst(__('app.gameTitle')); ?>" aria-label="<?php echo ucfirst(__('app.gameTitle')); ?>" aria-describedby="form_title">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary border border-secondary text-white" id="form_date">
                                    &nbsp;<i class="fas fa-calendar-check" aria-hidden="true" title="<?php echo ucfirst(__('app.gameDate')); ?>"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control border border-primary" name="game_releasedOn" value="<?php echo e($game->released_on); ?>" placeholder="<?php echo e(__('app.ddmmyy')); ?>" aria-label="<?php echo ucfirst(__('app.gameDate')); ?>" aria-describedby="form_date">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary border border-secondary text-white" id="form_mode">
                                    &nbsp;<i class="fas fa-list-ol" aria-hidden="true" title="<?php echo ucfirst(__('app.gameGenre')); ?>"></i>
                                </span>
                            </div>
                            <select multiple class="form-control border border-primary" name="modes[]" aria-label="<?php echo ucfirst(__('app.gameGenre')); ?>" aria-describedby="form_mode">
                                <option value="single" <?php if($game->mode === 'single'): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo ucfirst(__('app.gameSingle')); ?></option>
                                <option value="multi" <?php if($game->mode === 'multi'): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo ucfirst(__('app.gameMulti')); ?></option>
                                <option value="cooperative" <?php if($game->mode === 'cooperative'): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo ucfirst(__('app.gameCooperative')); ?></option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary border border-primary text-white" id="form_genre">
                                    &nbsp;<i class="fas fa-list-ul" aria-hidden="true" title="<?php echo ucfirst(__('app.gameMode')); ?>"></i>
                                </span>
                            </div>
                            <select multiple class="form-control border border-primary" name="genres[]" size="10" aria-label="<?php echo ucfirst(__('app.gameMode')); ?>" aria-describedby="form_genre">
                                <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($genre->uuid); ?>" <?php if($game->genres->contains($genre->uuid)): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($genre->genre); ?></option>
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
                            <select class="form-control border border-primary" name="studio_uuid" aria-label="<?php echo ucfirst(__('app.profession')); ?>" aria-describedby="form_studio">
                                <?php $__currentLoopData = $studios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $studio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($studio->uuid); ?>" <?php if($game->studio_uuid === $studio->uuid): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($studio->studio); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
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
                            <select multiple class="form-control border border-primary" name="consoles[]" size="10" aria-label="<?php echo ucfirst(__('app.console')); ?>" aria-describedby="form_consoles">
                                <?php $__currentLoopData = $consoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $console): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($console->uuid); ?>" <?php if($game->consoles->contains($console->uuid)): ?> <?php echo e('selected'); ?><?php endif; ?>><?php echo e($console->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col">
                                <h3 class="h4"><?php echo ucfirst(__('app.gameStaff')); ?></h3>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-secondary border border-secondary text-white" id="form_contact1">
                                    &nbsp;<i class="fas fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <select class="form-control border border-secondary" name="contact[1][profession]" aria-label="<?php echo ucfirst(__('app.profession')); ?>" aria-describedby="form_contact1">
                                <option value="" selected><?php echo ucfirst(__('app.professionsList')); ?></option>
                                <?php $__currentLoopData = $professions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profession): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($profession->uuid); ?>"><?php echo e($profession->profession); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <input type="text" class="form-control border border-secondary" name="contact[1][name]" id="game_contact1_name" placeholder="<?php echo ucfirst(__('app.contact')); ?>" aria-label="<?php echo ucfirst(__('app.contact')); ?>" aria-describedby="form_contact1">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-secondary border border-secondary text-white" id="form_contact2">
                                    &nbsp;<i class="fas fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <select class="form-control border border-secondary" name="contact[2][profession]" aria-label="<?php echo ucfirst(__('app.profession')); ?>" aria-describedby="form_contact2">
                                <option value="" selected><?php echo ucfirst(__('app.professionsList')); ?></option>
                                <?php $__currentLoopData = $professions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profession): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($profession->uuid); ?>"><?php echo e($profession->profession); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <input type="text" class="form-control border border-secondary" name="contact[2][name]" id="game_contact2_name" placeholder="<?php echo ucfirst(__('app.contact')); ?>" aria-label="<?php echo ucfirst(__('app.contact')); ?>" aria-describedby="form_contact2">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-secondary border border-secondary text-white" id="form_contact3">
                                    &nbsp;<i class="fas fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <select class="form-control border border-secondary" name="contact[3][profession]" aria-label="<?php echo ucfirst(__('app.profession')); ?>" aria-describedby="form_contact3">
                                <option value="" selected><?php echo ucfirst(__('app.professionsList')); ?></option>
                                <?php $__currentLoopData = $professions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profession): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($profession->uuid); ?>"><?php echo e($profession->profession); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <input type="text" class="form-control border border-secondary" name="contact[3][name]" id="game_contact3_name" placeholder="<?php echo ucfirst(__('app.contact')); ?>" aria-label="<?php echo ucfirst(__('app.contact')); ?>" aria-describedby="form_contact3">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-secondary border border-secondary text-white" id="form_contact4">
                                    &nbsp;<i class="fas fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <select class="form-control border border-secondary" name="contact[4][profession]" aria-label="<?php echo ucfirst(__('app.profession')); ?>" aria-describedby="form_contact4">
                                <option value="" selected><?php echo ucfirst(__('app.professionsList')); ?></option>
                                <?php $__currentLoopData = $professions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profession): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($profession->uuid); ?>"><?php echo e($profession->profession); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <input type="text" class="form-control border border-secondary" name="contact[4][name]" id="game_contact4_name" placeholder="<?php echo ucfirst(__('app.contact')); ?>" aria-label="<?php echo ucfirst(__('app.contact')); ?>" aria-describedby="form_contact4">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-secondary border border-secondary text-white" id="form_contact5">
                                    &nbsp;<i class="fas fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <select class="form-control border border-secondary" name="contact[5][profession]" aria-label="<?php echo ucfirst(__('app.profession')); ?>" aria-describedby="form_contact5">
                                <option value="" selected><?php echo ucfirst(__('app.professionsList')); ?></option>
                                <?php $__currentLoopData = $professions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profession): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($profession->uuid); ?>"><?php echo e($profession->profession); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <input type="text" class="form-control border border-secondary" name="contact[5][name]" id="game_contact5_name" placeholder="<?php echo ucfirst(__('app.contact')); ?>" aria-label="<?php echo ucfirst(__('app.contact')); ?>" aria-describedby="form_contact5">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-secondary border border-secondary text-white" id="form_contact6">
                                    &nbsp;<i class="fas fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <select class="form-control border border-secondary" name="contact[6][profession]" aria-label="<?php echo ucfirst(__('app.profession')); ?>" aria-describedby="form_contact6">
                                <option value="" selected><?php echo ucfirst(__('app.professionsList')); ?></option>
                                <?php $__currentLoopData = $professions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profession): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($profession->uuid); ?>"><?php echo e($profession->profession); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <input type="text" class="form-control border border-secondary" name="contact[6][name]" id="game_contact6_name" placeholder="<?php echo ucfirst(__('app.contact')); ?>" aria-label="<?php echo ucfirst(__('app.contact')); ?>" aria-describedby="form_contact6">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-secondary border border-secondary text-white" id="form_contact7">
                                    &nbsp;<i class="fas fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <select class="form-control border border-secondary" name="contact[7][profession]" aria-label="<?php echo ucfirst(__('app.profession')); ?>" aria-describedby="form_contact7">
                                <option value="" selected><?php echo ucfirst(__('app.professionsList')); ?></option>
                                <?php $__currentLoopData = $professions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profession): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($profession->uuid); ?>"><?php echo e($profession->profession); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <input type="text" class="form-control border border-secondary" name="contact[7][name]" id="game_contact7_name" placeholder="<?php echo ucfirst(__('app.contact')); ?>" aria-label="<?php echo ucfirst(__('app.contact')); ?>" aria-describedby="form_contact7">
                        </div>
                        <input type="hidden" name="contact[1][uuid]" id="game_contact1_uuid" value="">
                        <input type="hidden" name="contact[2][uuid]" id="game_contact2_uuid" value="">
                        <input type="hidden" name="contact[3][uuid]" id="game_contact3_uuid" value="">
                        <input type="hidden" name="contact[4][uuid]" id="game_contact4_uuid" value="">
                        <input type="hidden" name="contact[5][uuid]" id="game_contact5_uuid" value="">
                        <input type="hidden" name="contact[6][uuid]" id="game_contact6_uuid" value="">
                        <input type="hidden" name="contact[7][uuid]" id="game_contact7_uuid" value="">
                        <button type="submit" class="btn btn-primary mt-3 float-right"><?php echo ucfirst(__('app.gameUpdate')); ?></button>
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
                            <?php echo e($game->title); ?> <?php if($game->released_on): ?>(<?php echo ($game->released_on)->format('d/m/Y'); ?>)<?php endif; ?>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$( function() {
    $("#game_contact1_name").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.contact.autocomplete', ['q']); ?>=" + request.term, function (data) {
                response($.map(data, function (value, key) {
                    return {
                        uuid: value.uuid,
                        label: value.uname,
                        value: value.uname
                    };
                }));
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#game_contact1_uuid").val(ui.item.uuid);
		}
	});
    $("#game_contact2_name").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.contact.autocomplete', ['q']); ?>=" + request.term, function (data) {
                response($.map(data, function (value, key) {
                    return {
                        uuid: value.uuid,
                        label: value.uname,
                        value: value.uname
                    };
                }));
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#game_contact2_uuid").val(ui.item.uuid);
		}
	});
    $("#game_contact3_name").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.contact.autocomplete', ['q']); ?>=" + request.term, function (data) {
                response($.map(data, function (value, key) {
                    return {
                        uuid: value.uuid,
                        label: value.uname,
                        value: value.uname
                    };
                }));
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#game_contact3_uuid").val(ui.item.uuid);
		}
	});
    $("#game_contact4_name").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.contact.autocomplete', ['q']); ?>=" + request.term, function (data) {
                response($.map(data, function (value, key) {
                    return {
                        uuid: value.uuid,
                        label: value.uname,
                        value: value.uname
                    };
                }));
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#game_contact4_uuid").val(ui.item.uuid);
		}
	});
    $("#game_contact5_name").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.contact.autocomplete', ['q']); ?>=" + request.term, function (data) {
                response($.map(data, function (value, key) {
                    return {
                        uuid: value.uuid,
                        label: value.uname,
                        value: value.uname
                    };
                }));
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#game_contact5_uuid").val(ui.item.uuid);
		}
	});
    $("#game_contact6_name").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.contact.autocomplete', ['q']); ?>=" + request.term, function (data) {
                response($.map(data, function (value, key) {
                    return {
                        uuid: value.uuid,
                        label: value.uname,
                        value: value.uname
                    };
                }));
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#game_contact6_uuid").val(ui.item.uuid);
		}
	});
    $("#game_contact7_name").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.contact.autocomplete', ['q']); ?>=" + request.term, function (data) {
                response($.map(data, function (value, key) {
                    return {
                        uuid: value.uuid,
                        label: value.uname,
                        value: value.uname
                    };
                }));
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#game_contact7_uuid").val(ui.item.uuid);
		}
	});
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/philippe-alexandrepierre/Sites/laravel/laravel-podcast/resources/views/admin/game/edit.blade.php ENDPATH**/ ?>