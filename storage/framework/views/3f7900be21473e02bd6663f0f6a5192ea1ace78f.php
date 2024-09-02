<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h4 class="page-title">Section Customization</h4>
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
          <a href="#">Website Pages</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Settings</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Section Customization</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form class="" action="<?php echo e(route('user.sections.update', $lang_id)); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="card-title">Customize Sections</div>
                        </div>
                        <div class="col-lg-2">
                            <?php if(!empty($langs)): ?>
                            <select name="language" class="form-control" onchange="window.location='<?php echo e(url()->current() . '?language='); ?>'+this.value">
                                <option value="" selected disabled>Select a Language</option>
                                <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($lang->code); ?>" <?php echo e($lang->code == request()->input('language') ? 'selected' : ''); ?>><?php echo e($lang->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-5 pb-5">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label>Feature Section **</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="feature_section" value="1" class="selectgroup-input" <?php echo e($abs->feature_section == 1 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="feature_section" value="0" class="selectgroup-input" <?php echo e($abs->feature_section == 0 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Deactive</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Introduction Section **</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="intro_section" value="1" class="selectgroup-input" <?php echo e($abs->intro_section == 1 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="intro_section" value="0" class="selectgroup-input" <?php echo e($abs->intro_section == 0 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Deactive</span>
                                    </label>
                                </div>
                            </div>


                            <div class="form-group">
                                <label>Menu Section **</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="menu_section" value="1" class="selectgroup-input" <?php echo e($abs->menu_section == 1 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="menu_section" value="0" class="selectgroup-input" <?php echo e($abs->menu_section == 0 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Deactive</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Special Food Section **</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="special_section" value="1" class="selectgroup-input" <?php echo e($abs->special_section == 1 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="special_section" value="0" class="selectgroup-input" <?php echo e($abs->special_section == 0 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Deactive</span>
                                    </label>
                                </div>
                            </div>

                            <?php if($userBs->theme == 'fastfood'): ?>
                            <div class="form-group">
                                <label>Team Section **</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="team_section" value="1" class="selectgroup-input" <?php echo e($abs->team_section == 1 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="team_section" value="0" class="selectgroup-input" <?php echo e($abs->team_section == 0 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Deactive</span>
                                    </label>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label>Testimonial Section **</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="testimonial_section" value="1" class="selectgroup-input" <?php echo e($abs->testimonial_section == 1 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="testimonial_section" value="0" class="selectgroup-input" <?php echo e($abs->testimonial_section == 0 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Deactive</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>News Section **</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="news_section" value="1" class="selectgroup-input" <?php echo e($abs->news_section == 1 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="news_section" value="0" class="selectgroup-input" <?php echo e($abs->news_section == 0 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Deactive</span>
                                    </label>
                                </div>
                            </div>

                            <?php if($userBs->theme == 'fastfood'): ?>
                            <div class="form-group">
                                <label>Map Section **</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="table_section" value="1" class="selectgroup-input" <?php echo e($abs->table_section == 1 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="table_section" value="0" class="selectgroup-input" <?php echo e($abs->table_section == 0 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Deactive</span>
                                    </label>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label>Top Footer Section **</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="top_footer_section" value="1" class="selectgroup-input" <?php echo e($abs->top_footer_section == 1 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="top_footer_section" value="0" class="selectgroup-input" <?php echo e($abs->top_footer_section == 0 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Deactive</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Copyright Section **</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="copyright_section" value="1" class="selectgroup-input" <?php echo e($abs->copyright_section == 1 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="copyright_section" value="0" class="selectgroup-input" <?php echo e($abs->copyright_section == 0 ? 'checked' : ''); ?>>
                                        <span class="selectgroup-button">Deactive</span>
                                    </label>
                                </div>
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

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/user/basic/sections.blade.php ENDPATH**/ ?>