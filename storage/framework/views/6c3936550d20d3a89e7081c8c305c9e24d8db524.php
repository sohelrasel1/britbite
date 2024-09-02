<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Mail To Admin')); ?></h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('admin.dashboard')); ?>">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Basic Settings')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Email Settings')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Mail To Admin')); ?></a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form action="<?php echo e(route('admin.mailtoadmin.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="card-title"><?php echo e(__('Mail To Admin')); ?></div>
                  </div>
              </div>
          </div>
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                <div class="alert alert-warning text-center" role="alert">
                    <strong><?php echo e(__('This mail addres will be used to receive all mails from clients / buyers / inquirier.')); ?></strong>
                </div>
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label><?php echo e(__('Email Address')); ?> **</label>
                    <input class="form-control" type="email" name="to_mail" value="<?php echo e($abe->to_mail); ?>">
                    <?php if($errors->has('to_mail')): ?>
                        <p class="mb-0 text-danger"><?php echo e($errors->first('to_mail')); ?></p>
                    <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-success"><?php echo e(__('Update')); ?></button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/admin/basic/email/mail_to_admin.blade.php ENDPATH**/ ?>