
<div class="modal fade" id="addCurrentPackage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Current Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addCurrPackageForm" action="<?php echo e(route('user.currPackage.add')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                    <div class="form-group">
                        <label for="">Package **</label>
                        <select name="package_id" id="" class="form-control" required>
                            <option value="" selected disabled>Select a Package</option>
                            <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($package->id); ?>"><?php echo e($package->title); ?> (<?php echo e($package->term); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Payment Method</label>
                        <select name="payment_method" class="form-control">
                            <option value="" selected disabled>Select a Payment Method</option>
                            <?php $__currentLoopData = $gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($gateway->name); ?>" ><?php echo e($gateway->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="addCurrPackageForm" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
    </div>
<?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/admin/register_user/add-current-package.blade.php ENDPATH**/ ?>