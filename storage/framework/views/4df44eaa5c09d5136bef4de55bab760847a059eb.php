<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;use Carbon\Carbon;
?>


<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($keywords['Career'] ?? __('Career')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-keywords', !empty($userSeo) ? $userSeo->career_meta_keywords : ''); ?>
<?php $__env->startSection('meta-description', !empty($userSeo) ? $userSeo->career_meta_description : ''); ?>

<?php $__env->startSection('content'); ?>
 
    <?php echo $__env->make('user-front.breadcrum',['title' => $upageHeading?->career_page_title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



    <div class="job-lists">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <?php if(count($jobs) == 0): ?>
                            <div class="col-12 bg-light py-5">
                                <h3 class="text-center"><?php echo e($keywords["NO JOB FOUND"] ?? __('NO JOB FOUND')); ?></h3>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-12">
                                    <div class="single-job <?php if($loop->last): ?> mb-0 <?php endif; ?>">

                                        <h3>
                                            <a href="<?php echo e(route('user.front.career.details', [getParam(),$job->slug, $job->id])); ?>"
                                               class="title">
                                               <?php echo e(strlen(convertUtf8($job->title)) > 47 ? convertUtf8(substr($job->title, 0, 47)) . '...' : convertUtf8($job->title)); ?>

                                            </a></h3>

                                        <?php
                                            $deadline = Carbon::parse($job->deadline)->locale("$userCurrentLang->code");
                                            $deadline = $deadline->translatedFormat('jS F, Y');
                                        ?>

                                        <p class="deadline"><strong><i
                                                    class="far fa-calendar-alt"></i> <?php echo e($keywords["Deadline"] ?? __('Deadline')); ?>

                                                :</strong> <?php echo e($deadline); ?></p>
                                        <p class="education"><strong><i
                                                    class="fas fa-graduation-cap"></i> <?php echo e($keywords["Educational Experience"] ?? __('Educational Experience')); ?>:</strong> <?php echo (strlen(convertUtf8(strip_tags($job->educational_requirements))) > 110) ? convertUtf8(substr(strip_tags($job->educational_requirements), 0, 110)) . '...' : convertUtf8(strip_tags($job->educational_requirements)); ?>

                                        </p>
                                        <p class="experience"><strong><i class="fas fa-briefcase"></i>
                                        <?php echo e($keywords["Work Experience"] ?? __('Work Experience')); ?>:</strong> <?php echo e(convertUtf8($job->experience)); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <nav class="pagination-nav">
                                <?php echo e($jobs->appends(['category' => request()->input('category'), 'term' => request()->input('term')])->links()); ?>

                            </nav>
                        </div>
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
                            <h4><?php echo e($keywords["Job Categories"] ?? __('Job Categories')); ?></h4>
                            <ul>
                                <li class="single-category <?php echo e(empty(request()->input('category')) ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('user.front.career',getParam())); ?>"><?php echo e($keywords["All"] ?? __('All')); ?> <span>(<?php echo e($jobscount); ?>)</span></a>
                                </li>
                                <?php $__currentLoopData = $jcats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $jcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="single-category <?php echo e($jcat->id == request()->input('category') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('user.front.career', [getParam(),'category' => $jcat->id, 'term'=>request()->input('term')])); ?>"><?php echo e(convertUtf8($jcat->name)); ?>

                                            <span>(<?php echo e($jcat->jobs()->where('user_id',$user->id)->count()); ?>)</span></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make("user-front.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/user-front/fastfood/career.blade.php ENDPATH**/ ?>