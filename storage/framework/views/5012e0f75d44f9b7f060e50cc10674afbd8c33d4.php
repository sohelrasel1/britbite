<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>


<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($keywords['Career Details'] ?? __('Career Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-keywords', "$job->meta_keywords"); ?>
<?php $__env->startSection('meta-description', "$job->meta_description"); ?>
<?php $__env->startSection('content'); ?>
   

    <section class="page-title-area d-flex align-items-center"
    style="background-image: url('<?php echo e($userBs->breadcrumb ? Uploader::getImageUrl(Constant::WEBSITE_BREADCRUMB, $userBs->breadcrumb, $userBs) : asset('assets/restaurant/images/breadcrum.jpg')); ?>');background-size:cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-item text-center">
                        <h2 class="title"><?php echo e($upageHeading?->career_details_title); ?></h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo e(route('user.front.index',getParam())); ?>">
                                        <i class="flaticon-home"></i>
                                        <?php echo e($keywords["Home"] ??__('Home')); ?>

                                    </a>
                                </li>
                                <?php if($upageHeading?->career_details_title): ?>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo e($upageHeading?->career_details_title); ?></li>
                                <?php endif; ?>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="service-details-section pt-115 pb-115">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="job-details">
                        <h3><?php echo e(convertUtf8($job->title)); ?></h3>
                        <?php if(!empty($job->vacancy)): ?>
                            <div class="info">
                                <strong class="label"><?php echo e($keywords["Vacancy"] ?? __('Vacancy')); ?></strong>
                                <div class="desc"><?php echo e(convertUtf8($job->vacancy)); ?></div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty(convertUtf8($job->job_responsibilities))): ?>
                            <div class="info">
                                <strong class="label"><?php echo e($keywords["Job Responsibilities"] ?? __('Job Responsibilities')); ?></strong>
                                <div class="desc">
                                    <?php echo replaceBaseUrl(convertUtf8($job->job_responsibilities)); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty(convertUtf8($job->employment_status))): ?>
                            <div class="info">
                                <strong class="label"><?php echo e($keywords["Employment Status"] ?? __('Employment Status')); ?></strong>
                                <div class="desc"><?php echo e(convertUtf8($job->employment_status)); ?></div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty(convertUtf8($job->educational_requirements))): ?>
                            <div class="info">
                                <strong class="label"><?php echo e($keywords['Educational Requirements'] ?? __("Educational Requirements")); ?></strong>
                                <div class="desc">
                                    <?php echo replaceBaseUrl(convertUtf8($job->educational_requirements)); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty(convertUtf8($job->experience_requirements))): ?>
                            <div class="info">
                                <strong class="label"><?php echo e($keywords["Experience Requirements"] ?? __('Experience Requirements')); ?></strong>
                                <div class="desc">
                                    <?php echo replaceBaseUrl(convertUtf8($job->experience_requirements)); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty(convertUtf8($job->additional_requirements))): ?>
                            <div class="info">
                                <strong class="label"><?php echo e($keywords["Additional Requirements"] ?? __('Additional Requirements')); ?></strong>
                                <div class="desc">
                                    <?php echo replaceBaseUrl(convertUtf8($job->additional_requirements)); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty(convertUtf8($job->job_location))): ?>
                            <div class="info">
                                <strong class="label"><?php echo e($keywords["Job Location"] ?? __('Job Location')); ?></strong>
                                <div class="desc">
                                    <?php echo e(convertUtf8($job->job_location)); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty(convertUtf8($job->salary))): ?>
                            <div class="info">
                                <strong class="label"><?php echo e($keywords["Salary"] ?? __('Salary')); ?></strong>
                                <div class="desc">
                                    <?php echo replaceBaseUrl(convertUtf8($job->salary)); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty(convertUtf8($job->benefits))): ?>
                            <div class="info">
                                <strong class="label"><?php echo e($keywords["Compensation & Other Benefits"] ?? __('Compensation & Other Benefits')); ?></strong>
                                <div class="desc">
                                    <?php echo replaceBaseUrl(convertUtf8($job->benefits)); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty(convertUtf8($job->read_before_apply))): ?>
                            <div class="info">
                                <strong class="label"><?php echo e($keywords["Read Before Apply"] ?? __('Read Before Apply')); ?></strong>
                                <div class="desc">
                                    <?php echo replaceBaseUrl(convertUtf8($job->read_before_apply)); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty(convertUtf8($job->email))): ?>
                            <div class="info">
                                <strong class="label"><?php echo e($keywords["Email Address"] ?? __('Email Address')); ?></strong>
                                <div class="desc">
                                    <?php echo e($keywords["Send your CV to"] ?? __('Send your CV to')); ?>

                                    <strong class="text-danger">
                                        <?php echo e(convertUtf8($job->email)); ?>

                                    </strong>.
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
             
                <div class="col-lg-4">
                    <div class="blog-sidebar-widgets">
                        <div class="searchbar-form-section">
                            <form action="<?php echo e(route('user.front.career',getParam())); ?>">
                                <div class="searchbar">
                                    <input name="category" type="hidden" value="<?php echo e(request()->input('category')); ?>">
                                    <input name="term" type="text" placeholder="<?php echo e($keywords["Search Jobs"] ?? __('Search Jobs')); ?>"
                                           value="<?php echo e(request()->input('term')); ?>">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="blog-sidebar-widgets category-widget">
                        <div class="category-lists job">
                            <h4><?php echo e($keywords['Job Categories'] ?? __('Job Categories')); ?></h4>
                            <ul>
                                <li class="single-category">
                                    <a href="<?php echo e(route('user.front.career',getParam())); ?>"><?php echo e($keywords["All"] ?? __('All')); ?> <span>(<?php echo e($jobscount); ?>)</span></a>
                                </li>
                                <?php $__currentLoopData = $jcats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $jcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="single-category <?php echo e($job->jcategory->id == $jcat->id ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('user.front.career', [getParam(),'category' => $jcat->id, 'term'=>request()->input('term')])); ?>"><?php echo e(convertUtf8($jcat->name)); ?>

                                            <span>(<?php echo e($jcat->jobs()->where('user_id',$user->id)->count()); ?>)</span></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make("user-front.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/user-front/fastfood/career-details.blade.php ENDPATH**/ ?>