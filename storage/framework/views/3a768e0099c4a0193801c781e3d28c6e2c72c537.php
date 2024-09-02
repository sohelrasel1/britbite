<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Faqs')); ?></h4>
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
        <a href="#"><?php echo e(__('Home Page')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Faqs')); ?></a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card-title d-inline-block"><?php echo e(__('Faqs')); ?></div>
                </div>
                <div class="col-lg-3">
                    <?php if(!empty($langs)): ?>
                        <select name="language" class="form-control" onchange="window.location='<?php echo e(url()->current() . '?language='); ?>'+this.value">
                            <option value="" selected disabled><?php echo e(__('Select a Language')); ?></option>
                            <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($lang->code); ?>" <?php echo e($lang->code == request()->input('language') ? 'selected' : ''); ?>><?php echo e($lang->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                    <a href="#" class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> <?php echo e(__('Add Faq')); ?></a>
                    <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete" data-href="<?php echo e(route('admin.faq.bulk.delete')); ?>"><i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?></button>
                </div>
            </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($faqs) == 0): ?>
                <h3 class="text-center"><?php echo e(__('NO FAQ FOUND')); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                            <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Question')); ?></th>
                        <th scope="col"><?php echo e(__('Serial Number')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($faq->id); ?>">
                          </td>
                          <td><?php echo e(strlen($faq->question) > 50 ? mb_substr($faq->question, 0, 50, 'UTF-8') . '...' : $faq->question); ?></td>
                          <td><?php echo e($faq->serial_number); ?></td>
                          <td>
                            <a class="btn btn-secondary my-2 btn-sm editbtn" href="#editModal" data-toggle="modal" data-faq_id="<?php echo e($faq->id); ?>" data-question="<?php echo e($faq->question); ?>" data-answer="<?php echo e($faq->answer); ?>" data-serial_number="<?php echo e($faq->serial_number); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                             
                            </a>
                            <form class="deleteform d-inline-block" action="<?php echo e(route('admin.faq.delete')); ?>" method="post">
                              <?php echo csrf_field(); ?>
                              <input type="hidden" name="faq_id" value="<?php echo e($faq->id); ?>">
                              <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>
                                
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



  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Add Faq')); ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="ajaxForm" class="modal-form create" action="<?php echo e(route('admin.faq.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for=""><?php echo e(__('Language')); ?> **</label>
                <select name="language_id" class="form-control">
                    <option value="" selected disabled><?php echo e(__('Select a language')); ?></option>
                    <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lang->id); ?>"><?php echo e($lang->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <p id="errlanguage_id" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
              <label for=""><?php echo e(__('Question')); ?> **</label>
              <input type="text" class="form-control" name="question" value="" placeholder="<?php echo e(__('Enter question')); ?>">
              <p id="errquestion" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
              <label for=""><?php echo e(__('Answer')); ?> **</label>
              <textarea class="form-control" name="answer" rows="5" cols="80" placeholder="<?php echo e(__('Enter answer')); ?>"></textarea>
              <p id="erranswer" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
              <label for=""><?php echo e(__('Serial Number')); ?> **</label>
              <input type="number" class="form-control ltr" name="serial_number" value="" placeholder="<?php echo e(__('Enter Serial Number')); ?>">
              <p id="errserial_number" class="mb-0 text-danger em"></p>
              <p class="text-warning"><small><?php echo e(__('The higher the serial number is, the later the FAQ will be shown.')); ?></small></p>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
          <button id="submitBtn" type="button" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Edit Faq')); ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="ajaxEditForm" class="" action="<?php echo e(route('admin.faq.update')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input id="infaq_id" type="hidden" name="faq_id" value="">
            <div class="form-group">
              <label for=""><?php echo e(__('Question')); ?> **</label>
              <input id="inquestion" type="text" class="form-control" name="question" value="" placeholder="<?php echo e(__('Enter question')); ?>">
              <p id="eerrquestion" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
              <label for=""><?php echo e(__('Answer')); ?> **</label>
              <textarea id="inanswer" class="form-control" name="answer" rows="5" cols="80" placeholder="<?php echo e(__('Enter answer')); ?>"></textarea>
              <p id="eerranswer" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
              <label for=""><?php echo e(__('Serial Number')); ?> **</label>
              <input id="inserial_number" type="number" class="form-control ltr" name="serial_number" value="" placeholder="<?php echo e(__('Enter Serial Number')); ?>">
              <p id="eerrserial_number" class="mb-0 text-danger em"></p>
              <p class="text-warning"><small><?php echo e(__('The higher the serial number is, the later the FAQ will be shown.')); ?></small></p>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
          <button id="updateBtn" type="button" class="btn btn-primary"><?php echo e(__('Save Changes')); ?></button>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/admin/faq/index.blade.php ENDPATH**/ ?>