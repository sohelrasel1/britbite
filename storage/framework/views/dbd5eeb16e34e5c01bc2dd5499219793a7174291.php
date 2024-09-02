<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Languages')); ?></h4>
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
        <a href="#"><?php echo e(__('Language Management')); ?></a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block"><?php echo e(__('Languages')); ?></div>
          <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> <?php echo e(__('Language')); ?></a>
          <a href="#" class="btn btn-primary float-right mr-1" data-toggle="modal" data-target="#addKeywordModal"><i class="fas fa-plus"></i> <?php echo e(__('keyword')); ?></a>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($languages) == 0): ?>
                <h3 class="text-center"><?php echo e(__('NO LANGUAGE FOUND')); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo e(__('Name')); ?></th>
                        <th scope="col"><?php echo e(__('Code')); ?></th>
                        <th scope="col"><?php echo e(__('Appearance in Website')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($loop->iteration + 1); ?></td>
                          <td><?php echo e($language->name); ?></td>
                          <td><?php echo e($language->code); ?></td>
                          <td>
                            <?php if($language->is_default == 1): ?>
                              <strong class="badge badge-success"><?php echo e(__('Default')); ?></strong>
                            <?php else: ?>
                              <form class="d-inline-block" action="<?php echo e(route('admin.language.default', $language->id)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-primary btn-sm" type="submit" name="button"><?php echo e(__('Make Default')); ?></button>
                              </form>
                            <?php endif; ?>
                          </td>
                          <td>
                            <a class="btn btn-secondary btn-sm my-2" href="<?php echo e(route('admin.language.editKeyword', $language->id)); ?>">
                            <span class="btn-label">
                              <i class="fas fa-edit"></i>
                            </span>
                            <?php echo e(__('Edit Keyword')); ?>

                            </a>
                            <a class="btn btn-secondary my-2 btn-sm" href="<?php echo e(route('admin.language.edit', $language->id)); ?>">
                            <span class="btn-label">
                              <i class="fas fa-edit"></i>
                            </span>
                            <?php echo e(__('Edit')); ?>

                            </a>
                            <form class="deleteform d-inline-block" action="<?php echo e(route('admin.language.delete', $language->id)); ?>" method="post">
                              <?php echo csrf_field(); ?>
                              <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>
                                <?php echo e(__('Delete')); ?>

                              </button>
                            </form>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


  <?php if ($__env->exists('admin.language.create')) echo $__env->make('admin.language.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php if ($__env->exists('admin.language.add_keywords')) echo $__env->make('admin.language.add_keywords', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/admin/language/index.blade.php ENDPATH**/ ?>