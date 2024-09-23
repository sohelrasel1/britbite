<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title">Reservations Page Visibility</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('user.dashboard')); ?>">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Reservations Settings</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Visibility</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form action="<?php echo e(route('user.reservations.visibility.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="card-title">Reservations Page Visibility</div>
                  </div>
              </div>
          </div>
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                  <label>Request a Reservations Page Status **</label>
                  <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                            <input type="radio" name="is_quote" value="1" class="selectgroup-input" <?php echo e($userBs->is_quote == 1 ? 'checked' : ''); ?>>
                            <span class="selectgroup-button">Active</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="is_quote" value="0" class="selectgroup-input" <?php echo e($userBs->is_quote == 0 ? 'checked' : ''); ?>>
                            <span class="selectgroup-button">Deactive</span>
                        </label>
                    </div>
                    <?php if($errors->has('is_quote')): ?>
                        <p class="mb-0 text-danger"><?php echo e($errors->first('is_quote')); ?></p>
                    <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" id="displayNotif" class="btn btn-success">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/user/reservations/visibility.blade.php ENDPATH**/ ?>