<?php
  use App\Constants\Constant;
  use App\Http\Helpers\Uploader;
  use Illuminate\Support\Facades\Auth;

?>

<header class="header-area">
    <div class="navigation">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="support-bar">
              <div class="row">
                <div class="col-xl-6 d-none d-xl-block">
                  <div class="infos">
                    <?php if(!empty($userBs->support_email)): ?>
                      <span>
                        <i class="fas fa-envelope-open-text"></i>
                        <?php echo e(convertUtf8($userBs->support_email)); ?>

                      </span>
                    <?php endif; ?>
                    <?php if(!empty($userBs->support_phone)): ?>
                      <span>
                        <i class="fas fa-phone-alt"></i>
                        <?php echo e(convertUtf8($userBs->support_phone)); ?>

                      </span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-lg-12 col-xl-6 col-12">
                  <div class="links">
                    <?php if(!empty($socialMediaInfos) && $socialMediaInfos->count() > 0): ?>
                      <ul class="social-links">
                        <?php $__currentLoopData = $socialMediaInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <li><a href="<?php echo e($social->url); ?>" target="_blank"><i class="<?php echo e($social->icon); ?>"></i></a>
                          </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </ul>
                    <?php endif; ?>

                    <?php if(!empty($allLanguageInfos)): ?>
                      <div class="language">
                        <a class="language-btn" href="#"><i class="fas fa-globe-asia"></i>
                          <?php echo e(convertUtf8($userCurrentLang->name)); ?></a>
                        <ul class="language-dropdown">
                          <?php $__currentLoopData = $allLanguageInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                              <a href='<?php echo e(route('user.front.change.language', [getParam(), $lang->code])); ?>'>
                                <?php echo e(convertUtf8($lang->name)); ?>

                              </a>
                            </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </div>
                    <?php endif; ?>

                    <?php if(!Auth::guard('client')->check()): ?>
                      <?php if(!empty($packagePermissions) && in_array('Online Order', $packagePermissions)): ?>
                        <ul class="login">
                          <li>
                            <a
                              href="<?php echo e(route('user.client.login', getParam())); ?>"><?php echo e($keywords['Login'] ?? __('Login')); ?></a>
                          </li>
                        </ul>
                      <?php endif; ?>
                    <?php else: ?>
                    <?php if(!empty($packagePermissions) && in_array('Online Order', $packagePermissions)): ?>
                      <ul class="login">
                        <li>
                          <a
                            href="<?php echo e(route('user.client.dashboard', getParam())); ?>"><?php echo e($keywords['Dashboard'] ?? __('Dashboard')); ?></a>
                        </li>
                      </ul>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if(!empty($packagePermissions) && in_array('Online Order', $packagePermissions)): ?>
                      <div id="cartQuantity" class="cart">
                        <a href="<?php echo e(route('user.front.cart', getParam())); ?>">
                          <i class="fas fa-cart-plus"></i>
                          <?php
                            $itemsCount = 0;
                            $cart = session()->get(getUser()->username.'_cart');
                            if (!empty($cart)) {
                                foreach ($cart as $p) {
                                    $itemsCount += $p['qty'];
                                }
                            }
                          ?>
                          <span class="cart-quantity"><?php echo e($itemsCount); ?></span>
                        </a>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>

            <nav class="navbar navbar-expand-lg">
              <?php if($userBs->logo): ?>
                <a class="navbar-brand" href="<?php echo e(route('user.front.index', getParam())); ?>">
                  <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_LOGO, $userBs->logo, $userBs)); ?>"
                    alt="Logo">
                </a>
                <?php else: ?>
                <a class="navbar-brand" href="<?php echo e(route('user.front.index', getParam())); ?>">
                  <img src="<?php echo e(asset('assets/restaurant/images/logo.png')); ?>"
                    alt="Logo">
                </a>
              <?php endif; ?>


              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarFive"
                aria-controls="navbarFive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse sub-menu-bar" id="navbarFive">
                <ul class="navbar-nav m-xl-auto mr-auto">
                  <?php
                    $links = json_decode($userMenus, true);
                  ?>

                  <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                      $href = getUserHref($link, $userCurrentLang->id);
                    ?>

                    <?php if(!array_key_exists('children', $link)): ?>

                      <li class="nav-item">
                        <a class="page-scroll" href="<?php echo e($href); ?>" target="<?php echo e($link['target']); ?>">
                          <?php echo e($link['text']); ?>

                        </a>
                      </li>
                    <?php else: ?>

                      <li class="nav-item">
                        <a class="page-scroll" href="<?php echo e($href); ?>" target="<?php echo e($link['target']); ?>">
                          <?php echo e($link['text']); ?>

                          <i class="fa fa-angle-down"></i>
                        </a>

                        <ul class="sub-menu">
                          <?php $__currentLoopData = $link['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                              $l2Href = getUserHref($level2, $userCurrentLang->id);
                            ?>
                            <li class="nav-item <?php if(array_key_exists('children', $level2)): ?> submenus <?php endif; ?>">
                              <a class="page-scroll" href="<?php echo e($l2Href); ?>"
                                target="<?php echo e($level2['target']); ?>"><?php echo e($level2['text']); ?></a>


                              <?php
                                if (array_key_exists('children', $level2)) {
                                    create_user_menu($level2, $userCurrentLang->id);
                                }
                              ?>

                            </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </li>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php if(!is_null($packagePermissions) && in_array('Table Reservation', $packagePermissions) && $userBs->is_quote): ?>
                    <li class="nav-item d-block d-sm-none">
                      <a class="page-scroll" href="<?php echo e(route('user.front.reservation', getParam())); ?>">
                        <?php echo e($keywords['Reservation'] ?? __('Reservation')); ?>

                      </a>
                    </li>
                  <?php endif; ?>

                </ul>
              </div>

              <div class="navbar-btns d-flex align-items-center">
                <div class="header-times">
                  <?php if(!is_null($userBs->office_time)): ?>
                    <span>
                      <i class="flaticon-time"></i> <?php echo e($keywords['Opening Time'] ?? __('Opening Time')); ?>

                    </span>
                    <p><?php echo e($userBs->office_time); ?></p>
                  <?php endif; ?>
                </div>
                <?php if(
                    !is_null($packagePermissions) &&
                        in_array('Table Reservation', $packagePermissions) &&
                        $userBs->is_quote): ?>
                  <a class="main-btn main-btn-2 d-none d-sm-inline-block"
                    href="<?php echo e(route('user.front.reservation', getParam())); ?>">
                    <?php echo e($keywords['Reservation'] ?? __('Reservation')); ?>

                  </a>
                <?php endif; ?>
                <?php if(
                    !is_null($packagePermissions) &&
                        in_array('Call Waiter', $packagePermissions) &&
                        $userBs->website_call_waiter == 1): ?>
                  <a class="main-btn main-btn d-none d-sm-inline-block text-white ml-2" data-toggle="modal"
                    data-target="#callWaiterModal">
                    <?php echo e($keywords['Call Waiter'] ?? __('Call Waiter')); ?>

                  </a>
                <?php endif; ?>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
<?php /**PATH /var/www/html/saas/resources/views/user-front/fastfood/partials/header.blade.php ENDPATH**/ ?>