<?php
    use App\Constants\Constant;use App\Http\Helpers\UserPermissionHelper;
?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title"><?php echo e(__('User Details')); ?></h4>
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
                <a href="#">Users</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#"><?php echo e(__('User Details')); ?></a>
            </li>
        </ul>

        <a href="<?php echo e(route('admin.register.user')); ?>" class="btn-md btn btn-primary ml-auto"><?php echo e(__('Back')); ?></a>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center p-4">
                    <img
                        src="<?php echo e(!empty($user->image) ? asset(Constant::WEBSITE_TENANT_USER_IMAGE.'/'.$user->image) : asset('assets/admin/img/noimage.jpg')); ?>"
                        alt="" width="100%">
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <?php if(session()->has('membership_warning')): ?>
                <div class="alert alert-warning text-dark">
                    <?php echo e(session()->get('membership_warning')); ?>

                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo e(__('User Details')); ?></h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <strong><?php echo e(__('Username:')); ?></strong>
                        </div>
                        <div class="col-lg-6">
                            <?php echo e($user->username ?? '-'); ?>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <strong><?php echo e(__('Path Based URL:')); ?></strong>
                        </div>
                        <div class="col-lg-6">
                            <a href="//<?php echo e(env('WEBSITE_HOST') . '/' . $user->username); ?>" target="_blank">
                                <?php echo e(env('WEBSITE_HOST') . '/' . $user->username); ?>

                            </a>
                        </div>
                    </div>

                    <?php
                        $features = UserPermissionHelper::packagePermission($user->id);
                        $features = json_decode($features, true);
                    ?>

                    <?php if(!empty($features) && is_array($features) && in_array('Subdomain', $features)): ?>
                        <?php
                            $subdomain = strtolower($user->username) . '.' . env('WEBSITE_HOST');
                        ?>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <strong><?php echo e(__('Subdomain:')); ?></strong>
                            </div>
                            <div class="col-lg-6">
                                <a href="//<?php echo e($subdomain); ?>" target="_blank"><?php echo e($subdomain); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($features) && is_array($features) && in_array('Custom Domain', $features)): ?>
                        <?php
                            $cdomains = $user->custom_domains()->where('status', 1);
                        ?>
                        <?php if($cdomains->count() > 0): ?>
                            <?php
                                $cdomain = $cdomains->orderBy('id', 'DESC')->first()->requested_domain;
                            ?>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <strong><?php echo e(__('Custom Domain:')); ?></strong>
                                </div>
                                <div class="col-lg-6">
                                    <a href="//<?php echo e($cdomain); ?>" target="_blank"><?php echo e($cdomain); ?></a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>


                    <?php
                        $currPackage = UserPermissionHelper::currPackageOrPending($user->id);
                        $currMemb = UserPermissionHelper::currMembOrPending($user->id);
                    ?>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <strong><?php echo e(__('Current Package:')); ?></strong>
                        </div>
                        <div class="col-lg-6">
                            <?php if($currPackage): ?>
                                <a target="_blank"
                                   href="<?php echo e(route('admin.package.edit', $currPackage->id)); ?>"><?php echo e($currPackage->title); ?></a>
                                <span class="badge badge-secondary badge-xs mr-2"><?php echo e($currPackage->term); ?></span>
                                <button type="submit" class="btn btn-xs btn-warning" data-toggle="modal"
                                        data-target="#editCurrentPackage"><i class="far fa-edit"></i></button>
                                <form action="<?php echo e(route('user.currPackage.remove')); ?>" class="d-inline-block deleteform"
                                      method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                                    <button type="submit" class="btn btn-xs btn-danger deletebtn"><i
                                            class="fas fa-trash"></i></button>
                                </form>

                                <p class="mb-0">
                                    <?php if($currMemb->is_trial == 1): ?>
                                        (Expire Date: <?php echo e(Carbon\Carbon::parse($currMemb->expire_date)->format('M-d-Y')); ?>)
                                        <span class="badge badge-primary">Trial</span>
                            <?php else: ?>
                                (Expire Date: <?php echo e($currPackage->term === 'lifetime' ? "Lifetime" : Carbon\Carbon::parse($currMemb->expire_date)->format('M-d-Y')); ?>)
                            <?php endif; ?>
                            <?php if($currMemb->status == 0): ?>
                                <form id="statusForm<?php echo e($currMemb->id); ?>" class="d-inline-block"
                                      action="<?php echo e(route('admin.payment-log.update')); ?>"
                                      method="post">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo e($currMemb->id); ?>">
                                    <select class="form-control form-control-sm bg-warning" name="status"
                                            onchange="document.getElementById('statusForm<?php echo e($currMemb->id); ?>').submit();">
                                        <option value=0 selected>Pending</option>
                                        <option value=1>Success</option>
                                        <option value=2>Rejected</option>
                                    </select>
                                </form>
                                <?php endif; ?>
                                </p>

                            <?php else: ?>
                                <a data-target="#addCurrentPackage" data-toggle="modal"
                                   class="btn btn-xs btn-primary text-white"><i class="fas fa-plus"></i> Add Package</a>
                            <?php endif; ?>
                        </div>
                    </div>


                    <?php
                        $nextPackage = UserPermissionHelper::nextPackage($user->id);
                        $nextMemb = UserPermissionHelper::nextMembership($user->id);
                    ?>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <strong><?php echo e(__('Next Package:')); ?></strong>
                        </div>
                        <div class="col-lg-6">
                            <?php if($nextPackage): ?>
                                <a target="_blank"
                                   href="<?php echo e(route('admin.package.edit', $nextPackage->id)); ?>"><?php echo e($nextPackage->title); ?></a>
                                <span class="badge badge-secondary badge-xs mr-2"><?php echo e($nextPackage->term); ?></span>
                                <button type="button" class="btn btn-xs btn-warning" data-toggle="modal"
                                        data-target="#editNextPackage"><i class="far fa-edit"></i></button>
                                <form action="<?php echo e(route('user.nextPackage.remove')); ?>" class="d-inline-block deleteform"
                                      method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                                    <button type="submit" class="btn btn-xs btn-danger deletebtn"><i
                                            class="fas fa-trash"></i></button>
                                </form>

                                <p class="mb-0">
                                    <?php if($currPackage->term != 'lifetime' && $nextMemb->is_trial != 1): ?>
                                        (
                                        Activation Date:
                                        <?php echo e(Carbon\Carbon::parse($nextMemb->start_date)->format('M-d-Y')); ?>,
                                        Expire
                                        Date: <?php echo e($nextPackage->term === 'lifetime' ?  "Lifetime" : Carbon\Carbon::parse($nextMemb->expire_date)->format('M-d-Y')); ?>

                                        )
                            <?php endif; ?>
                            <?php if($nextMemb->status == 0): ?>
                                <form id="statusForm<?php echo e($nextMemb->id); ?>" class="d-inline-block"
                                      action="<?php echo e(route('admin.payment-log.update')); ?>"
                                      method="post">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo e($nextMemb->id); ?>">
                                    <select class="form-control form-control-sm bg-warning" name="status"
                                            onchange="document.getElementById('statusForm<?php echo e($nextMemb->id); ?>').submit();">
                                        <option value=0 selected>Pending</option>
                                        <option value=1>Success</option>
                                        <option value=2>Rejected</option>
                                    </select>
                                </form>
                                <?php endif; ?>
                                </p>
                            <?php else: ?>
                                <?php if(!empty($currPackage)): ?>
                                    <a class="btn btn-xs btn-primary text-white" data-toggle="modal"
                                       data-target="#addNextPackage"><i class="fas fa-plus"></i> Add Package</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <strong><?php echo e(__('First Name:')); ?></strong>
                        </div>
                        <div class="col-lg-6">
                            <?php echo e($user->first_name ?? '-'); ?>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <strong><?php echo e(__('Last Name:')); ?></strong>
                        </div>
                        <div class="col-lg-6">
                            <?php echo e($user->last_name ?? '-'); ?>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <strong><?php echo e(__('Company Name:')); ?></strong>
                        </div>
                        <div class="col-lg-6">
                            <?php echo e($user->company_name ?? '-'); ?>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <strong><?php echo e(__('Email:')); ?></strong>
                        </div>
                        <div class="col-lg-6">
                            <?php echo e($user->email ?? '-'); ?>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <strong><?php echo e(__('Number:')); ?></strong>
                        </div>
                        <div class="col-lg-6">
                            <?php echo e($user->phone ?? '-'); ?>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <strong><?php echo e(__('City:')); ?></strong>
                        </div>
                        <div class="col-lg-6">
                            <?php echo e($user->city ?? '-'); ?>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <strong><?php echo e(__('State:')); ?></strong>
                        </div>
                        <div class="col-lg-6">
                            <?php echo e($user->state ?? '-'); ?>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <strong><?php echo e(__('Country:')); ?></strong>
                        </div>
                        <div class="col-lg-6">
                            <?php echo e($user->country); ?>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <strong><?php echo e(__('Address:')); ?></strong>
                        </div>
                        <div class="col-lg-6">
                            <?php echo e($user->address); ?>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <strong><?php echo e(__('Email Status:')); ?></strong>
                        </div>
                        <div class="col-lg-6">
                            <?php if($user->email_verified == 1): ?>
                                <span class="badge badge-success"><?php echo e(__('Verified')); ?></span>
                            <?php elseif($user->email_verified == 0): ?>
                                <span class="badge badge-danger"><?php echo e(__('Not Verified')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <strong><?php echo e(__('Account Status:')); ?></strong>
                        </div>
                        <div class="col-lg-6">
                            <?php if($user->status == 1): ?>
                                <span class="badge badge-success"><?php echo e(__('Active')); ?></span>
                            <?php elseif($user->status == 0): ?>
                                <span class="badge badge-danger"><?php echo e(__('Banned')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <?php if ($__env->exists('admin.register_user.edit-current-package')) echo $__env->make('admin.register_user.edit-current-package', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if ($__env->exists('admin.register_user.add-current-package')) echo $__env->make('admin.register_user.add-current-package', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if ($__env->exists('admin.register_user.edit-next-package')) echo $__env->make('admin.register_user.edit-next-package', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if ($__env->exists('admin.register_user.add-next-package')) echo $__env->make('admin.register_user.add-next-package', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/admin/register_user/details.blade.php ENDPATH**/ ?>