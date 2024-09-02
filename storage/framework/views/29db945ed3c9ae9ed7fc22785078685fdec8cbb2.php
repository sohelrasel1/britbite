<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
    use Carbon\Carbon;
?>

<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($keywords['Blog'] ?? __('Blog')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-keywords', !empty($userSeo) ? $userSeo->blogs_meta_keywords : ''); ?>
<?php $__env->startSection('meta-description', !empty($userSeo) ? $userSeo->blogs_meta_description : ''); ?>

<?php $__env->startSection('content'); ?>
   

  <?php echo $__env->make('user-front.breadcrum',['title' => $upageHeading?->blog_page_title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <section class="blog-area  pt-80 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-lg-4 col-md-7 col-sm-8">
                        <div class="single-blog mt-30">
                            <div class="blog-thumb">
                                <img class="lazy wow fadeIn"
                                     data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_BLOG_IMAGE,$blog->image,$userBs)); ?>"
                                     alt="blog-image"
                                     data-wow-delay=".5s">
                            </div>
                            <div class="blog-content">
                                <a href="<?php echo e(route('user.front.blog.details', [getParam(),$blog->slug, $blog->id])); ?>">
                                    <h3 class="title">
                                        <?php echo e(strlen(convertUtf8($blog->title)) > 27 ? mb_substr(convertUtf8($blog->title), 0, 27, 'UTF-8') . '...' : convertUtf8($blog->title)); ?>

                                    </h3>
                                </a>
                                <p><?php echo e((strlen(strip_tags(convertUtf8($blog->content))) > 100) ? substr(strip_tags(convertUtf8($blog->content)), 0, 100) . '...' : strip_tags(convertUtf8($blog->content))); ?></p>
                                <div class="blog-comments d-block d-sm-flex justify-content-between align-items-center">
                                    <a href="<?php echo e(route('user.front.blog.details',[getParam(),$blog->slug, $blog->id])); ?>"><?php echo e($keywords['Read More'] ?? __('Read More')); ?></a>
                                    <ul>
                                        <?php
                                            app()->setLocale($userCurrentLang->code);
                                        ?>
                                        <li>
                                            <i class="far fa-calendar-alt"></i>
                                            <span><?php echo e(Carbon::parse($blog->created_at)->diffForHumans()); ?></span>
                                            <span>|</span>
                                            <span><?php echo e(getUser()->username); ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12 text-center bg-light py-5 text-center">
                        <h3><?php echo e($keywords['NO BLOG POST FOUND!'] ?? __('NO BLOG POST FOUND!')); ?></h3>
                    </div>
                <?php endif; ?>

                <div class="col-lg-12">
                    <div class="pagination-part">
                        <?php echo e($blogs->appends(['category' => request()->input('category')])->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user-front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/user-front/fastfood/blogs.blade.php ENDPATH**/ ?>