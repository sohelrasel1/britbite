<?php
    use App\Models\User\Language;
    use Illuminate\Support\Facades\Auth;
?>


<?php
    $setLang = Language::query()
        ->where([['code', request()->input('language')], ['user_id', Auth::guard('web')->user()->id]])
        ->first();
?>
<?php if(!empty($setLang) && $setLang->rtl == 1): ?>
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
        <h4 class="page-title">Jobs</h4>
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
                <a href="#">Career Page</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Jobs</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-title d-inline-block">Jobs</div>
                        </div>
                        <div class="col-lg-3">
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
                        <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                            <a href="<?php echo e(route('user.job.create') . '?language=' . request()->input('language')); ?>"
                                class="btn btn-primary float-lg-right float-left btn-sm"><i class="fas fa-plus"></i> Post
                                Job</a>
                            <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete"
                                data-href="<?php echo e(route('user.job.bulk.delete')); ?>"><i class="flaticon-interface-5"></i>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(count($jobs) == 0): ?>
                                <h3 class="text-center">NO JOB FOUND</h3>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped mt-3" id="basic-datatables">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <input type="checkbox" class="bulk-check" data-val="all">
                                                </th>
                                                <th scope="col" width="40%">Title</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Vacancy</th>
                                                <th scope="col">Serial Number</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="bulk-check"
                                                            data-val="<?php echo e($job->id); ?>">
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo e(route('user.front.career.details', [$tusername, $job->slug, $job->id])); ?>"
                                                            target="_blank">
                                                            <?php echo e(strlen(convertUtf8($job->title)) > 120 ? convertUtf8(substr($job->title, 0, 120)) . '...' : convertUtf8($job->title)); ?>

                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php if(!empty($job->jcategory)): ?>
                                                            <?php echo e(convertUtf8($job->jcategory->name)); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e($job->vacancy); ?></td>
                                                    <td><?php echo e($job->serial_number); ?></td>
                                                    <td>
                                                        <a class="btn my-2 btn-secondary btn-sm"
                                                            href="<?php echo e(route('user.job.edit', $job->id) . '?language=' . request()->input('language')); ?>">
                                                            <span class="btn-label">
                                                                <i class="fas fa-edit"></i>
                                                            </span>
                                                            
                                                        </a>
                                                        <form class="deleteform d-inline-block"
                                                            action="<?php echo e(route('user.job.delete')); ?>" method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="job_id"
                                                                value="<?php echo e($job->id); ?>">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/user/job/job/index.blade.php ENDPATH**/ ?>