<?php
    $lims_user_list = DB::table('users')->where([['is_active', true], ['id', '!=', \Auth::user()->id]])->get();
?>

<?php $__env->startComponent('components.modal'); ?>
    <?php $__env->slot('title', trans('file.Send Notification')); ?> 
    <?php $__env->slot('id', 'notification-modal'); ?>
    <p class="italic">
        <small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small>
    </p>

    <?php echo Form::open(['route' => 'notifications.store', 'method' => 'post']); ?>

    <div class="row">
        <div class="col-md-6 form-group">
            <label><?php echo e(trans('file.User')); ?> *</label>
            <select name="user_id" class="selectpicker form-control" required data-live-search="true"
                data-live-search-style="begins" title="Select user...">
                <?php $__currentLoopData = $lims_user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name . ' (' . $user->email . ')'); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-12 form-group">
            <label><?php echo e(trans('file.Message')); ?> *</label>
            <textarea rows="5" name="message" class="form-control" required></textarea>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
    </div>
    <?php echo e(Form::close()); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH D:\laragon\www\mlk-tokomas\resources\views/main_utilities/notification_modal.blade.php ENDPATH**/ ?>