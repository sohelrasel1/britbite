
<aside class="sidebar-widget-area">

    <div class="widget widget-post mb-30">
        <h3 class="title"><?php echo e(__('Recent Posts')); ?></h3>
        <?php $__currentLoopData = $allBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <article class="article-item mb-30">
                <div class="image">
                    <a href="<?php echo e(route('front.blog.details',['id' => $blog->id,'slug' => $blog->slug])); ?>" class="lazy-container aspect-ratio-1-1">
                        <img class="lazyload lazy-image" src="<?php echo e(asset('assets/front/img/blogs/'.$blog->main_image)); ?>"
                             data-src="<?php echo e(asset('assets/front/img/blogs/'.$blog->main_image)); ?>" alt="Blog Image">
                    </a>
                </div>
                <div class="content">
                    <h6>
                        <a href="<?php echo e(route('front.blog.details',['id' => $blog->id,'slug' => $blog->slug])); ?>"><?php echo e($blog->title); ?></a>
                    </h6>
                    <div class="time">
                        <?php echo e($blog->created_at->diffForHumans()); ?>

                    </div>
                </div>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="widget widget-social-link mb-30">
        <h3 class="title"><?php echo e(__('Share')); ?></h3>
        <div class="social-link">
            <a href="//www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="//twitter.com/intent/tweet?text=my share text&amp;url=<?php echo e(urlencode(url()->current())); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="//www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo e(urlencode(url()->current())); ?>&amp;title=<?php echo e($blog->title); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>
    <div class="widget widget-categories mb-30">
        <h3 class="title"><?php echo e(__('Categories')); ?></h3>
        <ul class="list-unstyled m-0">
            <?php $__currentLoopData = $bcats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="d-flex align-items-center justify-content-between <?php if(request()->input('category') == $bcat->id): ?> active <?php endif; ?>">
                <a href="<?php echo e(route('front.blogs', ['category'=>$bcat->id])); ?>"><i class="fal fa-folder"></i><?php echo e($bcat->name); ?></a>
                <span class="tqy">(11)</span>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</aside>

<?php /**PATH /var/www/html/saas/resources/views/front/partials/blog-sidebar.blade.php ENDPATH**/ ?>