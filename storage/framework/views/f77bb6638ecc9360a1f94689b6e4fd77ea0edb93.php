<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>


<?php if(!empty($abs->language) && $abs->language->rtl == 1): ?>
    <?php $__env->startSection('styles'); ?>
        <style>
            form:not(.modal-form) input,
            form:not(.modal-form) textarea,
            form:not(.modal-form) select,
            select[name='language'] {
                direction: rtl;
            }

            form:not(.modal-form) .note-editor.note-frame .note-editing-area .note-editable {
                direction: rtl;
                text-align: right;
            }
        </style>
    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title">Team Section</h4>
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
                <a href="#">Home Page</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Team Section</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="card-title d-inline-block">Members</div>
                    <a href="<?php echo e(route('user.member.create') . '?language=' . request()->input('language')); ?>"
                        class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add Member</a>
                        </div>
                        <div class="col-lg-2">
                            <?php if(!empty($userLangs)): ?>
                                <select name="language" class="form-control"
                                    onchange="window.location='<?php echo e(url()->current() . '?language='); ?>'+this.value">
                                    <option value="" selected disabled>Select a Language</option>
                                    <?php $__currentLoopData = $userLangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($lang->code); ?>"
                                            <?php echo e($lang->code == request()->input('language') ? 'selected' : ''); ?>>
                                            <?php echo e($lang->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(count($members) == 0): ?>
                                <h3 class="text-center">NO MEMBER FOUND</h3>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped mt-3">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Rank</th>
                                                <th scope="col">Featured</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td><img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_MEMBER_IMAGES, $member->image, $userBs)); ?>"
                                                            alt="" width="80"></td>
                                                    <td><?php echo e(convertUtf8($member->name)); ?></td>
                                                    <td><?php echo e($member->rank); ?></td>
                                                    <td>
                                                        <form id="featureForm<?php echo e($member->id); ?>" class="d-inline-block"
                                                            action="<?php echo e(route('user.member.feature')); ?>" method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="member_id"
                                                                value="<?php echo e($member->id); ?>">
                                                            <select
                                                                class="form-control <?php echo e($member->feature == 1 ? 'bg-success' : 'bg-danger'); ?>"
                                                                name="feature"
                                                                onchange="document.getElementById('featureForm<?php echo e($member->id); ?>').submit();">
                                                                <option value="1"
                                                                    <?php echo e($member->feature == 1 ? 'selected' : ''); ?>>
                                                                    Yes
                                                                </option>
                                                                <option value="0"
                                                                    <?php echo e($member->feature == 0 ? 'selected' : ''); ?>>No
                                                                </option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-secondary btn-sm my-2"
                                                            href="<?php echo e(route('user.member.edit', $member->id) . '?language=' . request()->input('language')); ?>">
                                                            <span class="btn-label">
                                                                <i class="fas fa-edit"></i>
                                                            </span>

                                                        </a>
                                                        <form class="deleteform d-inline-block"
                                                            action="<?php echo e(route('user.member.delete')); ?>" method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="member_id"
                                                                value="<?php echo e($member->id); ?>">
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm deletebtn">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/user/home/member/index.blade.php ENDPATH**/ ?>