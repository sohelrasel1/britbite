<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Add Page')); ?></h4>
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
        <a href="#"><?php echo e(__('Custom Pages')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Add Page')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block"><?php echo e(__('Add Page')); ?></div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="<?php echo e(route('user.custom_pages', ['language' => $defaultLang->code])); ?>">
            <span class="btn-label">
              <i class="fas fa-backward" ></i>
            </span>
            <?php echo e(__('Back')); ?>

          </a>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <div class="alert alert-danger pb-1 dis-none" id="pageErrors">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul></ul>
              </div>

              <form id="pageForm" action="<?php echo e(route('user.custom_pages.store_page')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group px-0">
                      <label for=""><?php echo e(__('Page Status*')); ?></label>
                      <select name="status" class="form-control">
                        <option selected disabled><?php echo e(__('Select a Status')); ?></option>
                        <option value="1"><?php echo e(__('Active')); ?></option>
                        <option value="0"><?php echo e(__('Deactive')); ?></option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="accordion accordion-secondary mt-3" id="accordion">
                  <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card">
                        <div class="card-header <?php echo e($language->is_default == 1 ? '' : 'collapsed'); ?>" id="heading<?php echo e($language->id); ?>" data-toggle="collapse"
                            data-target="#collapse<?php echo e($language->id); ?>"
                            aria-expanded="<?php echo e($language->is_default == 1 ? 'true' : 'false'); ?>"
                            aria-controls="collapse<?php echo e($language->id); ?>">
                        <div class="span-title">
                            <?php echo e($language->name . __(' Language')); ?>

                            <?php echo e($language->is_default == 1 ? '(Default)' : ''); ?>

                        </div>
                        <div class="span-mode"></div>
                      </div>

                      <div id="collapse<?php echo e($language->id); ?>" class="collapse <?php echo e($language->is_default == 1 ? 'show' : ''); ?>"
                        aria-labelledby="heading<?php echo e($language->id); ?>" data-parent="#accordion">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group <?php echo e($language->rtl == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Title*')); ?></label>
                                <input type="text" class="form-control" name="<?php echo e($language->code); ?>_title" placeholder="Enter Title">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group <?php echo e($language->rtl == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Content*')); ?></label>
                                <textarea class="form-control summernote" name="<?php echo e($language->code); ?>_content" placeholder="Enter Content" data-height="300"></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group <?php echo e($language->rtl == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Meta Keywords')); ?></label>
                                <input class="form-control" name="<?php echo e($language->code); ?>_meta_keywords" placeholder="Enter Meta Keywords" data-role="tagsinput">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group <?php echo e($language->rtl == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Meta Description')); ?></label>
                                <textarea class="form-control" name="<?php echo e($language->code); ?>_meta_description" rows="5" placeholder="Enter Meta Description"></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <?php $currLang = $language; ?>

                              <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($language->id == $currLang->id) continue; ?>

                                <div class="form-check py-0">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" onchange="cloneInput('collapse<?php echo e($currLang->id); ?>', 'collapse<?php echo e($language->id); ?>', event)">
                                    <span class="form-check-sign"><?php echo e(__('Clone for')); ?> <strong class="text-capitalize text-secondary"><?php echo e($language->name); ?></strong> <?php echo e(__('language')); ?></span>
                                  </label>
                                </div>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" form="pageForm" class="btn btn-success">
                <?php echo e(__('Save')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('assets/tenant/js/partial.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/user/custom-page/create.blade.php ENDPATH**/ ?>