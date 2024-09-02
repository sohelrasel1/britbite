<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>
<?php $__currentLoopData = $apopups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $popup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $type = $popup->type;
    ?>
    <?php if($type == 1): ?>
        <div data-popup_delay="<?php echo e($popup->delay); ?>" data-popup_id="<?php echo e($popup->id); ?>" id="modal-popup<?php echo e($popup->id); ?>"
             class="popup-wrapper">
            <div>
                <img class="lazy"
                     data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_ANNOUNCEMENT_POPUP_IMAGE,$popup->image,$userBs)); ?>"
                     alt="Popup Image" width="100%">
            </div>
        </div>
    <?php elseif($type == 2): ?>
        <div data-popup_delay="<?php echo e($popup->delay); ?>" data-popup_id="<?php echo e($popup->id); ?>" id="modal-popup<?php echo e($popup->id); ?>"
             class="popup-wrapper">
           
            <div class="popup-one bg_cover lazy"
                 data-bg="<?php echo e(asset(Uploader::getImageUrl(Constant::WEBSITE_ANNOUNCEMENT_POPUP_IMAGE,$popup->image,$userBs))); ?>">
                <div class="popup_main-content">
                    <h1><?php echo e($popup->title); ?></h1>
                    <p><?php echo e($popup->text); ?></p>

                    <?php if(!empty($popup->button_url) && !empty($popup->button_text)): ?>
                        <a href="<?php echo e($popup->button_url); ?>" class="popup-main-btn"
                           style="background-color: #<?php echo e($popup->button_color); ?>;"><?php echo e($popup->button_text); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php elseif($type == 3): ?>
        <div data-popup_delay="<?php echo e($popup->delay); ?>" data-popup_id="<?php echo e($popup->id); ?>" id="modal-popup<?php echo e($popup->id); ?>"
             class="popup-wrapper">
            <div class="popup-two bg_cover lazy"
                 data-bg="<?php echo e(asset(Uploader::getImageUrl(Constant::WEBSITE_ANNOUNCEMENT_POPUP_IMAGE,$popup->image,$userBs))); ?>">
                <div class="popup_main-content">
                    <h1><?php echo e($popup->title); ?></h1>
                    <p><?php echo e($popup->text); ?></p>
                    <div class="subscribe-form">
                        <form id="popupSubscribe<?php echo e($popup->id); ?>" class="subscribeForm"
                              action="<?php echo e(route('user.front.subscribe',getParam())); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form_group">
                                <input type="email" class="form_control" placeholder="<?php echo e($keywords['Enter Email Address'] ?? __('Enter Email Address')); ?>"
                                       name="email" required>
                                <p id="erremail" class="text-white mb-3 err-email"></p>
                            </div>
                            <div class="form_group">
                                <button type="submit" class="popup-main-btn"
                                        style="background-color: #<?php echo e($popup->button_color); ?>;">
                                    <?php echo e($popup->button_text); ?>

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif($type == 4): ?>
        <div data-popup_delay="<?php echo e($popup->delay); ?>" data-popup_id="<?php echo e($popup->id); ?>" id="modal-popup<?php echo e($popup->id); ?>"
             class="popup-wrapper">
            <div class="popup-three">
                <div class="popup_main-content">
                    <div class="left-bg bg_cover lazy"
                         data-bg="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_ANNOUNCEMENT_POPUP_IMAGE,$popup->image,$userBs)); ?>">
                    </div>
                    <div class="right-content">
                        <h1><?php echo e($popup->title); ?></h1>
                        <p><?php echo e($popup->text); ?></p>
                        <?php if(!empty($popup->button_url) && !empty($popup->button_text)): ?>
                            <a href="<?php echo e($popup->button_url); ?>" class="popup-main-btn"
                               style="background-color: #<?php echo e($popup->button_color); ?>;">
                                <?php echo e($popup->button_text); ?>

                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif($type == 5): ?>
        <div data-popup_delay="<?php echo e($popup->delay); ?>" data-popup_id="<?php echo e($popup->id); ?>" id="modal-popup<?php echo e($popup->id); ?>"
             class="popup-wrapper">
            <div class="popup-four">
                <div class="popup_main-content">
                    <div class="left-bg bg_cover lazy"
                         data-bg="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_ANNOUNCEMENT_POPUP_IMAGE,$popup->image,$userBs)); ?>"></div>
                    <div class="right-content">
                        <h1><?php echo e($popup->title); ?></h1>
                        <p><?php echo e($popup->text); ?></p>
                        <div class="subscribe-form">
                            <form id="popupSubscribe<?php echo e($popup->id); ?>" class="subscribeForm"
                                  action="<?php echo e(route('user.front.subscribe',getParam())); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="form_group">
                                    <input type="email" class="form_control" placeholder="<?php echo e($keywords['Enter Email Address'] ?? __('Enter Email Address')); ?>"
                                           name="email" required>
                                    <p id="erremail" class="text-danger mb-3 err-email"></p>
                                </div>
                                <div class="form_group">
                                    <button type="submit" class="popup-main-btn"
                                            style="background-color: #<?php echo e($popup->button_color); ?>;"><?php echo e($popup->button_text); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif($type == 6): ?>
        <div data-popup_delay="<?php echo e($popup->delay); ?>" data-popup_id="<?php echo e($popup->id); ?>" id="modal-popup<?php echo e($popup->id); ?>"
             class="popup-wrapper">
            <div class="popup-five bg_cover lazy"
                 data-bg="<?php echo e(asset(Uploader::getImageUrl(Constant::WEBSITE_ANNOUNCEMENT_POPUP_IMAGE,$popup->image,$userBs))); ?>">
                <div class="popup_main-content">
                    <h1><?php echo e($popup->title); ?></h1>
                    <h4><?php echo e($popup->text); ?></h4>
                    <div class="offer-timer" data-end_date="<?php echo $popup->end_date; ?>"
                         data-end_time="<?php echo $popup->end_time; ?>"></div>
                    <?php if(!empty($popup->button_url) && !empty($popup->button_text)): ?>
                        <a href="<?php echo e($popup->button_url); ?>" class="popup-main-btn"
                           style="background-color: #<?php echo e($popup->button_color); ?>;"><?php echo e($popup->button_text); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php elseif($type == 7): ?>
        <div data-popup_delay="<?php echo e($popup->delay); ?>" data-popup_id="<?php echo e($popup->id); ?>" id="modal-popup<?php echo e($popup->id); ?>"
             class="popup-wrapper">
            <div class="popup-six">
                <div class="popup_main-content">
                    <div class="left-bg bg_cover lazy"
                         data-bg="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_ANNOUNCEMENT_POPUP_IMAGE,$popup->image,$userBs)); ?>"></div>
                    <div class="right-content bg_cover"
                         style="background-color: #<?php echo e($popup->background_color); ?>; background-image: url(<?php echo e(asset('assets/front/img/popup-7-bg.png')); ?>);">
                        <h1><?php echo e($popup->title); ?></h1>
                        <h4><?php echo e($popup->text); ?></h4>
                        <div class="offer-timer" data-end_date="<?php echo $popup->end_date; ?>"
                             data-end_time="<?php echo $popup->end_time; ?>"></div>
                        <?php if(!empty($popup->button_url) && !empty($popup->button_text)): ?>
                            <a href="<?php echo e($popup->button_url); ?>" class="popup-main-btn"
                               style="background-color: #<?php echo e($popup->button_color); ?>;"><?php echo e($popup->button_text); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /var/www/html/saas/resources/views/user-front/partials/popups.blade.php ENDPATH**/ ?>