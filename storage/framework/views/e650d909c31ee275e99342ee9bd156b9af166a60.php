<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>



<?php if(!empty($member->language) && $member->language->rtl == 1): ?>
    <?php $__env->startSection('styles'); ?>
        <style>
            form input,
            form textarea,
            form select {
                direction: rtl;
            }
            .nicEdit-main {
                direction: rtl;
                text-align: right;
            }
        </style>
    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title">Edit Member</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
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
                <a href="#">Home Page</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Edit Member</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-inline-block">Edit Member</div>
                    <a class="btn btn-info btn-sm float-right d-inline-block"
                       href="<?php echo e(route('user.member.index') . '?language=' . request()->input('language')); ?>">
                        <span class="btn-label">
                          <i class="fas fa-backward"></i>
                        </span>
                        Back
                    </a>
                </div>
                <div class="card-body pt-5 pb-5">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">

                            <form id="ajaxForm" class="" action="<?php echo e(route('user.member.update')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="col-12 mb-2">
                                                <label for="image"><strong>Image</strong></label>
                                            </div>
                                            <div class="col-md-12 showImage mb-3">
                                                <img
                                                    src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_MEMBER_IMAGES,$member->image, $userBs)); ?>"
                                                    alt="..." class="img-thumbnail" width="200">
                                            </div>
                                            <input type="file" name="image" id="image" class="form-control image">
                                            <p id="errimage" class="mb-0 text-danger em"></p>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="member_id" value="<?php echo e($member->id); ?>">
                                <div class="form-group">
                                    <label for="">Name **</label>
                                    <input type="text" class="form-control" name="name" value="<?php echo e($member->name); ?>"
                                           placeholder="Enter name">
                                    <p id="errname" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Rank **</label>
                                    <input type="text" class="form-control" name="rank" value="<?php echo e($member->rank); ?>"
                                           placeholder="Enter rank">
                                    <p id="errrank" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Facebook</label>
                                    <input type="text" class="form-control ltr" name="facebook"
                                           value="<?php echo e($member->facebook); ?>" placeholder="Enter facebook url">
                                    <p id="errfacebook" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Twitter</label>
                                    <input type="text" class="form-control ltr" name="twitter"
                                           value="<?php echo e($member->twitter); ?>" placeholder="Enter twitter url">
                                    <p id="errtwitter" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Instagram</label>
                                    <input type="text" class="form-control ltr" name="instagram"
                                           value="<?php echo e($member->instagram); ?>" placeholder="Enter instagram url">
                                    <p id="errinstagram" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Linkedin</label>
                                    <input type="text" class="form-control ltr" name="linkedin"
                                           value="<?php echo e($member->linkedin); ?>" placeholder="Enter linkedin url">
                                    <p id="errlinkedin" class="mb-0 text-danger em"></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form">
                        <div class="form-group from-show-notify row">
                            <div class="col-12 text-center">
                                <button type="submit" id="submitBtn" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/user/home/member/edit.blade.php ENDPATH**/ ?>