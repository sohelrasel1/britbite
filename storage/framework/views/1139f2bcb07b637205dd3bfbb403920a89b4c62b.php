<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Mail Subscribers')); ?></h4>
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
        <a href="#"><?php echo e(__('Subscribers')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Mail Subscribers')); ?></a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <form class="" action="<?php echo e(route('admin.subscribers.sendmail')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="card-title"><?php echo e(__('Send Mail')); ?></div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-8 offset-lg-2">
                  <div class="form-group">
                    <label for=""><?php echo e(__('Subject')); ?> **</label>
                    <input type="text" class="form-control" name="subject" value="" placeholder="<?php echo e(__('Enter subject of E-mail')); ?>">
                    <?php if($errors->has('subject')): ?>
                      <p class="text-danger mb-0"><?php echo e($errors->first('subject')); ?></p>
                    <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <label for=""><?php echo e(__('Message')); ?> **</label>
                    <textarea name="message" class="form-control summernote" data-height="150"></textarea>
                        <?php if($errors->has('message')): ?>
                          <p class="text-danger mb-0"><?php echo e($errors->first('message')); ?></p>
                        <?php endif; ?>
                  </div>
              </div>
            </div>
          </div>
          <div class="card-footer text-center">
            <button type="submit" class="btn btn-success">
                <span class="btn-label">
                    <i class="fa fa-check"></i>
                </span>
                <?php echo e(__('Send Mail')); ?>

  			</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/admin/subscribers/mail.blade.php ENDPATH**/ ?>