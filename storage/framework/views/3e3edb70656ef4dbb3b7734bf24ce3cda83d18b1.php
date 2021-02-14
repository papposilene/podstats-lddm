<!-- Modal: modalGenreCreate -->
<div class="modal fade" id="modalGenreCreate" tabindex="-1" role="dialog" aria-labelledby="modalGenreCreateTitle" aria-hidden="true">
    <form method="POST" action="<?php echo e(route('admin.genre.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="modal-dialog modal-dialog-centered" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalGenreCreateTitle">
						<?php echo ucfirst(__('app.genreCreate')); ?>
					</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border border-primary text-white">
                                <i class="fas fa-list-alt" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control border border-primary" name="genre_name" placeholder="<?php echo ucfirst(__('app.genre')); ?>" aria-label="<?php echo ucfirst(__('app.genre')); ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo ucfirst(__('app.close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo ucfirst(__('app.genreStore')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div><?php /**PATH /Users/philippe-alexandrepierre/Sites/laravel/laravel-podcast/resources/views/modals/genreCreate.blade.php ENDPATH**/ ?>