<?php $__env->startSection('title', @ucfirst(__('app.contactEdit', ['contact' => $contact->uname]))); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-8">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
            <h1 class="h2 text-white">
                <?php echo ucfirst(__('app.contactEdit', ['contact' => $contact->uname])); ?>
            </h1>
        </div>

        <form method="POST" action="<?php echo e(route('admin.contact.update')); ?>" class="needs-validation" novalidate />
            <?php echo csrf_field(); ?>
            <input type="hidden" name="contact_uuid" value="<?php echo e($contact->uuid); ?>" />
            <div class="form-row mt-2">
                <div class="col">
                    <h3 class="h4"><?php echo ucfirst(__('app.detailsIdentity')); ?></h3>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-primary border border-primary text-white" id="form_uname">
                        <i class="fas fa-user-secret" aria-hidden="true" title="<?php echo ucfirst(__('app.uname')); ?>"></i>
                    </span>
                </div>
                <input type="text" class="form-control border border-primary" name="contact_uname" value="<?php echo e($contact->uname); ?>" placeholder="<?php echo ucfirst(__('app.uname')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.uname')); ?>" aria-describedby="form_uname" required />
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white" id="form_gender">
                                <i class="fas fa-transgender-alt" aria-hidden="true" title="<?php echo ucfirst(__('app.gender')); ?>"></i>
                            </span>
                        </div>
                        <select class="form-control border border-primary" name="contact_gender" aria-label="<?php echo ucfirst(__('app.gender')); ?>" aria-describedby="form_gender" required />
                            <option value=""><?php echo ucfirst(__('app.gender')); ?></option>
                            <option value="band"<?php if($contact->gender === 'band'): ?> selected <?php endif; ?>><?php echo ucfirst(__('app.band')); ?></option>
                            <option value="feminine"<?php if($contact->gender === 'feminine'): ?> selected <?php endif; ?>><?php echo ucfirst(__('app.feminine')); ?></option>
                            <option value="masculine"<?php if($contact->gender === 'masculine'): ?> selected <?php endif; ?>><?php echo ucfirst(__('app.masculine')); ?></option>
                            <option value="neutral"<?php if($contact->gender === 'neutral'): ?> selected <?php endif; ?>><?php echo ucfirst(__('app.neutral')); ?></option>
                            <option value="unknown"<?php if($contact->gender === 'unknown'): ?> selected <?php endif; ?>><?php echo ucfirst(__('app.unknown')); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_fname">
                                <i class="fas fa-user" aria-hidden="true" title="<?php echo ucfirst(__('app.fname')); ?>"></i>
                                <span class="sr-only"><?php echo ucfirst(__('app.fname')); ?></span>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="contact_fname" value="<?php echo e($contact->fname); ?>" placeholder="<?php echo ucfirst(__('app.fname')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.fname')); ?>" aria-describedby="form_fname" />
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_mname">
                                <i class="fas fa-user" aria-hidden="true" title="<?php echo ucfirst(__('app.mname')); ?>"></i>
                                <span class="sr-only"><?php echo ucfirst(__('app.mname')); ?></span>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="contact_mname" value="<?php echo e($contact->mname); ?>" placeholder="<?php echo ucfirst(__('app.mname')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.mname')); ?>" aria-describedby="form_mname" />
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_lname">
                                <i class="fas fa-user" aria-hidden="true" title="<?php echo ucfirst(__('app.lname')); ?>"></i>
                                <span class="sr-only"><?php echo ucfirst(__('app.lname')); ?></span>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="contact_lname" value="<?php echo e($contact->lname); ?>" placeholder="<?php echo ucfirst(__('app.lname')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.lname')); ?>" aria-describedby="form_lname" />
                    </div>
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="col">
                    <h3 class="h4"><?php echo ucfirst(__('app.detailsBiography')); ?></h3>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-secondary border border-secondary text-white" id="form_livesAt">
                        <i class="fas fa-map-marked" aria-hidden="true" title="<?php echo ucfirst(__('app.livesAt')); ?>"></i>
                    </span>
                </div>
                <input type="text" class="form-control border border-secondary" id="formLivesAt" value="<?php if($contact->lives_at): ?><?php echo e($contact->livesAt->name_eng_common); ?><?php endif; ?>" placeholder="<?php echo ucfirst(__('app.livesAt')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.livesAt')); ?>" aria-describedby="form_livesAt" />
                <input type="hidden" name="contact_livesAt" id="contacFormLivesAt" value="<?php if($contact->lives_at): ?><?php echo e($contact->lives_at); ?><?php endif; ?>" />
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_bornOn">
                                <i class="fas fa-calendar-check" aria-hidden="true" title="<?php echo ucfirst(__('app.bornOn')); ?>"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="contact_bornOn" value="<?php if($contact->born_on): ?><?php echo ($contact->born_on)->format('Y-m-d'); ?><?php endif; ?>" placeholder="1970-01-01" aria-label="<?php echo ucfirst(__('app.bornOn')); ?>" autocomplete="off" aria-describedby="form_bornOn" />
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_bornAt">
                                <i class="fas fa-globe" aria-hidden="true" title="<?php echo ucfirst(__('app.bornAt')); ?>"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" id="formBornAt" value="<?php if($contact->born_at): ?><?php echo e($contact->bornAt->name_eng_common); ?><?php endif; ?>" placeholder="<?php echo ucfirst(__('app.bornAt')); ?>" autocomplete="off" aria-label="<?php echo ucfirst(__('app.bornAt')); ?>" aria-describedby="form_bornAt" />
                        <input type="hidden" name="contact_bornAt" id="contactFormBornAt" value="<?php if($contact->born_at): ?><?php echo e($contact->born_at); ?><?php endif; ?>" required />
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_diedOn">
                                <i class="fas fa-calendar-times" aria-hidden="true" title="<?php echo ucfirst(__('app.diedOn')); ?>"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" name="contact_diedOn" value="<?php if($contact->died_on): ?><?php echo ($contact->died_on)->format('Y-m-d'); ?><?php endif; ?>" placeholder="2000-12-31" aria-label="<?php echo ucfirst(__('app.diedOn')); ?>" autocomplete="off" aria-describedby="form_diedOn" />
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary border border-secondary text-white" id="form_diedAt">
                                <i class="fas fa-globe" aria-hidden="true" title="<?php echo ucfirst(__('app.diedAt')); ?>"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-secondary" id="formDiedAt" value="<?php if($contact->died_at): ?><?php echo e($contact->diedAt->name_eng_common); ?><?php endif; ?>" placeholder="<?php echo ucfirst(__('app.diedAt')); ?>" aria-label="<?php echo ucfirst(__('app.diedAt')); ?>" aria-describedby="form_diedAt" />
                        <input type="hidden" name="contact_diedAt" id="contactFormDiedAt" value="<?php if($contact->died_at): ?><?php echo e($contact->died_at); ?><?php endif; ?>" />
                    </div>
                </div>
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-secondary border border-secondary text-white">
                        <i class="fas fa-audio-description" aria-hidden="true" title="<?php echo ucfirst(__('app.biography')); ?>"></i>
                    </span>
                </div>
                <textarea class="form-control border border-secondary" rows="10" name="contact_biography" placeholder="<?php echo ucfirst(__('app.biography')); ?>" aria-label="<?php echo ucfirst(__('app.biography')); ?>"><?php echo e($contact->description); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3 float-right"><?php echo ucfirst(__('app.contactUpdate')); ?></button>
        </form>
    </div>
    <div class="col-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-3 border-bottom">
            <h2 class="h2 text-white">
                <i class="fas fa-list-ol" aria-hidden="true" title="<?php echo ucfirst(__('app.dataLast')); ?>"></i>
                <?php echo ucfirst(__('app.dataLast')); ?>
            </h2>
        </div>

        <?php if(count($contact->hasEpisodes) > 0): ?>
        <div class="list-group list-group-flush">
            <?php $__currentLoopData = $contact->hasEpisodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $episode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('admin.episode.show', ['uuid' => $episode->hasEpisode->uuid])); ?>" class="list-group-item list-group-item-action">
                <?php echo e($episode->hasEpisode->title); ?>

            </a>
            <?php if($loop->iteration == 5) break; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

        <?php if(count($contact->hasGames) > 0): ?>
        <div class="list-group list-group-flush">
            <?php $__currentLoopData = $contact->hasGames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('admin.game.show', ['uuid' => $game->hasGame->uuid])); ?>" class="list-group-item list-group-item-action">
                <?php echo e($game->hasGame->title); ?>

            </a>
            <?php if($loop->iteration == 5) break; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

        <?php if(count($contact->hasTracks) > 0): ?>
        <div class="list-group list-group-flush">
            <?php $__currentLoopData = $contact->hasTracks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('admin.track.show', ['uuid' => $track->uuid])); ?>" class="list-group-item list-group-item-action">
                <?php echo e($track->hasComposed->title); ?>

            </a>
            <?php if($loop->iteration == 5) break; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$( function() {
    $("#formLivesAt").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.country.autocomplete', ['q']); ?>=" + request.term, function (data) {
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
                            cca3: value.cca3,
                            label: value.name_eng_common,
                            value: value.name_eng_common
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#contacFormLivesAt").val(ui.item.uuid);
		}
	});
    $("#formNationality").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.country.autocomplete', ['q']); ?>=" + request.term, function (data) {
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
                            cca3: value.cca3,
                            label: value.name_eng_common,
                            value: value.name_eng_common
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#contactFormNationality").val(ui.item.uuid);
		}
	});
    $("#formBornAt").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.country.autocomplete', ['q']); ?>=" + request.term, function (data) {
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
                            cca3: value.cca3,
                            label: value.name_eng_common,
                            value: value.name_eng_common
                        };
                    }));
                }
            });
        },
		minLength: 3,
		select: function( event, ui ) {
            $("#contactFormBornAt").val(ui.item.uuid);
		}
	});
    $("#formDiedAt").autocomplete({
        source: function (request, response) {
            $.getJSON("<?php echo route('api.country.autocomplete', ['q']); ?>=" + request.term, function (data) {
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
                            cca3: value.cca3,
                            label: value.name_eng_common,
                            value: value.name_eng_common
                        };
                    }));
                }
            });
        },
        minLength: 3,
        select: function( event, ui ) {
            $("#contactFormDiedAt").val(ui.item.uuid);
        }
	});
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/data/web/vhosts/lddm.psln.nl/resources/views/admin/contact/edit.blade.php ENDPATH**/ ?>