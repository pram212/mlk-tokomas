<?php $__env->startComponent('components.modal'); ?>
    <?php $__env->slot('title', trans('file.User Report')); ?> 
    <?php $__env->slot('id', 'user-modal'); ?>

    <p class="italic">
        <small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small>
    </p>
    <?php
        $lims_user_list = DB::table('users')->where('is_active', true)->get();
    ?>
    <?php echo Form::open(['route' => 'report.user', 'method' => 'post']); ?>

    <div class="form-group">
        <label><?php echo e(trans('file.User')); ?> *</label>
        <select name="user_id" class="selectpicker form-control" required data-live-search="true"
            id="user-id" data-live-search-style="begins" title="Select user...">
            <?php $__currentLoopData = $lims_user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name . ' (' . $user->phone . ')'); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <input type="hidden" name="start_date" value="<?php echo e(date('Y-m') . '-' . '01'); ?>" />
    <input type="hidden" name="end_date" value="<?php echo e(date('Y-m-d')); ?>" />

    <div class="form-group">
        <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
    </div>
    <?php echo e(Form::close()); ?>

<?php echo $__env->renderComponent(); ?><?php /**PATH D:\laragon\www\mlk-tokomas\resources\views/main_utilities/user_modal.blade.php ENDPATH**/ ?>