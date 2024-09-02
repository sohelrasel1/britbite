<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
    use App\Models\User\Table;
    use App\Models\User\Ulink;
    use Illuminate\Support\Facades\Auth;

?>
<!DOCTYPE html>
<html lang="en" dir="<?php echo e($userCurrentLang->rtl == 1 ? 'rtl' : ''); ?>">

<head>

    <?php if($userBs->is_analytics == 1): ?>
        <script async src="//www.googletagmanager.com/gtag/js?id=<?php echo e($userBs->measurement_id); ?>"></script>
        <script>
            "use strict";
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', '<?php echo e($userBs->measurement_id); ?>');
        </script>
    <?php endif; ?>


    <meta charset="utf-8">

    <?php if(is_array($packagePermissions) && in_array('PWA Installability', $packagePermissions)): ?>
        <link rel="manifest" crossorigin="use-credentials" href="<?php echo e(request()->root() . '/assets/pwa/manifest.json'); ?>" />
    <?php endif; ?>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo $__env->yieldContent('meta-description'); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('meta-keywords'); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('pageHeading'); ?> <?php echo e($userBs->website_title !== null ? '|' . ' ' : ''); ?> <?php echo e($userBs->website_title); ?></title>

    <link rel="shortcut icon"
        href="<?php echo e($userBs->favicon ? Uploader::getImageUrl(Constant::WEBSITE_FAVICON, $userBs->favicon, $userBs) : ''); ?>"
        type="image/png">

    <?php if(count($allLanguageInfos) == 0): ?>
        <style media="screen">
            .support-bar-area ul.social-links li:last-child {
                margin-right: 0;
            }

            .support-bar-area ul.social-links::after {
                display: none;
            }
        </style>
    <?php endif; ?>
    <?php if($userBs->feature_section == 0): ?>
        <style media="screen">
            .hero-txt {
                padding-bottom: 160px;
            }
        </style>
    <?php endif; ?>


    

    <?php if($userBs->is_tawkto == 1 || $userBs->is_whatsapp == 1): ?>
        <style>
            .go-top-area .go-top.active {
                right: auto;
                left: 20px;
            }
        </style>
    <?php endif; ?>
    <?php if($rtl == 0): ?>
        <style>
            .navigation .cart a::before {
                left: 17px;
            }

            .navigation .navbar .navbar-nav .nav-item {
                position: relative;
                margin: 0 15px;
            }
        </style>
    <?php else: ?>
        <style>
            .navigation .cart a::before {
                right: -29px;
            }

            .navigation .navbar .navbar-nav .nav-item {
                position: relative;
                margin: 0 20px;
            }

            .field-input.cross i.fa-times-circle {
                position: absolute;
                color: #000;
                left: 8px;
                top: 16px;
                cursor: pointer;
                text-align: left
            }

            .cart-total-table {
                border: 1px solid #e8e6f4;
                border-radius: 6px;
                margin-bottom: 30px;
                text-align: right
            }

            .cart-total-table li {
                direction: rtl
            }
        </style>
    <?php endif; ?>




    <?php if($userBs->is_recaptcha == 1): ?>
        <script type="text/javascript">
            var onloadCallback = function() {
                if ($("#g-recaptcha").length > 0) {
                    grecaptcha.render('g-recaptcha', {
                        'sitekey': '<?php echo e($userBs->google_recaptcha_site_key); ?>'
                    });
                }
            };
        </script>
    <?php endif; ?>

    
    <?php if ($__env->exists('user-front.plugin_css')) echo $__env->make('user-front.plugin_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if ($__env->exists('user-front.themes_css')) echo $__env->make('user-front.themes_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('style'); ?>

    
    <?php if ($__env->exists('user-front.themes_header_footer_css')) echo $__env->make('user-front.themes_header_footer_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <link rel="stylesheet"
        href="<?php echo e(asset('assets/front/css/styles.php?color=' . str_replace('#', '', $userBs->base_color))); ?>">
    

    
    <?php if ($__env->exists('user-front.plugin_js')) echo $__env->make('user-front.plugin_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    


</head>

<?php
    $bodyClass = '';
    if ($activeTheme == 'bakery') {
        $bodyClass = 'theme-dark';
    }
?>

<body class="<?php echo e($bodyClass); ?>">

    
    <?php if($userBs->preloader_status == 1): ?>
        <div id="preloader">
            <div class="loader revolve">
                <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRELOADER, $userBs->preloader, $userBs)); ?>"
                    alt="">
            </div>
        </div>
    <?php endif; ?>
    

    

    <div class="request-loader">
        <img src="<?php echo e(asset('assets/admin/img/loader.gif')); ?>" alt="">
    </div>

    

    
    <?php if ($__env->exists('user-front.themes_header')) echo $__env->make('user-front.themes_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

    <?php echo $__env->yieldContent('content'); ?>

    
    <?php if ($__env->exists('user-front.themes_footer')) echo $__env->make('user-front.themes_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

    <?php if ($__env->exists('user-front.partials.popups')) echo $__env->make('user-front.partials.popups', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php if ($__env->exists('user-front.partials.variation-modal')) echo $__env->make('user-front.partials.variation-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    


    <?php if($activeTheme == 'fastfood'): ?>
        <div class="go-top-area">
            <div class="go-top-wrap">
                <div class="go-top-btn-wrap">
                    <div class="go-top go-top-btn">
                        <i class="fa fa-angle-double-up"></i>
                        <i class="fa fa-angle-double-up"></i>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        
        <div class="go-top"><i class="fal fa-angle-up"></i></div>
    <?php endif; ?>

    <div id="WAButton"></div>



    <?php if($userBe->cookie_alert_status == 1): ?>
        <div class="cookie">
            <?php echo $__env->make('cookie-consent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    <?php endif; ?>

    <div class="modal fade" id="callWaiterModal" tabindex="-1" role="dialog" aria-labelledby="callWaiterModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        <?php echo e($keywords['Call Waiter'] ?? __('Call Waiter')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                        $tables = Table::query()
                            ->where('status', 1)
                            ->where('user_id', $user->id)
                            ->get();
                    ?>
                    <form id="callWaiterForm" action="<?php echo e(route('user.front.call.waiter', getParam())); ?>"
                        method="GET">
                        <select class="form-control" name="table" required>
                            <option value="" disabled selected>
                                <?php echo e($keywords['Select a Table'] ?? __('Select a Table')); ?>

                            </option>
                            <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($table->table_no); ?>"><?php echo e($keywords['Table'] ?? __('Table')); ?> -
                                    <?php echo e($table->table_no); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="callWaiterForm" class="btn base-btn text-white">
                        <?php echo e($keywords['Call Waiter'] ?? __('Call Waiter')); ?>

                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        "use strict";
        const mainurl = "<?php echo e(url('/')); ?>";
        let userCheckoutUrl = "<?php echo e(route('user.front.add.cart', [getParam(), ':id'])); ?>";
        const lat = '<?php echo e($userBs->latitude); ?>';
        const sessionLang = '<?php echo e(session()->get('user_lang')); ?>';
        const currentLang = '<?php echo e($userCurrentLang->code); ?>';
        const lng = '<?php echo e($userBs->longitude); ?>';
        const rtl = <?php echo e($rtl); ?>;
        const position = "<?php echo e($userBe->base_currency_symbol_position); ?>";
        const symbol = "<?php echo e($userBe->base_currency_symbol); ?>";
        const textPosition = "<?php echo e($userBe->base_currency_text_position); ?>";
        const currText = "<?php echo e($userBe->base_currency_text); ?>";
        const vap_pub_key = "<?php echo e($userBex->VAPID_PUBLIC_KEY); ?>";
        const pathName = "<?php echo e(getParam()); ?>";
        var pusherAppKey = "<?php echo e($userBe->pusher_app_key ?? ''); ?>";
        var pusherCluster = "<?php echo e($userBe->pusher_app_cluster ?? ''); ?>";
        var demo_mode = "<?php echo e(env('DEMO_MODE')); ?>";

        const offlineImg = "<?php echo e(public_path('/assets/front/img/offline.png')); ?>";
        let select = "<?php echo e($keywords['Select'] ?? __('Select')); ?>";
    </script>


    <?php echo $__env->make('user-front.themes_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    
    <?php echo $__env->make('user-front.themes_header_footer_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->yieldContent('script'); ?>
    

    <?php if($userCurrentLang?->datepicker_name): ?>
        <script>
            var datepickerpath =
                "<?php echo e(asset('assets/tenant/js/i18n/' . $userCurrentLang->datepicker_name . '-' . $userCurrentLang->code . '.js')); ?>";
            $(function() {

                $.getScript(datepickerpath)
                    .done(function() {

                        $("input.datepicker").datepicker({
                            minDate: 0,
                            dayNames: $.datepicker.regional[currentLang].dayNames,
                            monthNames: $.datepicker.regional[currentLang].monthNames,

                        });
                    })
                    .fail(function() {

                    });

            });
        </script>
    <?php endif; ?>

    <?php if(session()->has('success')): ?>
        <script>
            "use strict";
            toastr["success"]("<?php echo e(__(session('success'))); ?>");
        </script>
    <?php endif; ?>

    <?php if(session()->has('warning')): ?>
        <script>
            "use strict";
            toastr["warning"]("<?php echo e(__(session('warning'))); ?>");
        </script>
    <?php endif; ?>

    <?php if(session()->has('error')): ?>
        <script>
            "use strict";
            toastr["error"]("<?php echo e(__(session('error'))); ?>");
        </script>
    <?php endif; ?>

    <?php if($userBs->is_facebook_pixel == 1): ?>
        <!-- Meta Pixel Code -->
        <script>
            ! function(f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function() {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '<?php echo e($userBs->pixel_id); ?>');
            fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
                src="https://www.facebook.com/tr?id=<?php echo e($userBs->pixel_id); ?>&ev=PageView&noscript=1" /></noscript>
        <!-- End Meta Pixel Code -->
    <?php endif; ?>

    
    <?php if($userBs->is_whatsapp == 1): ?>
        <script type="text/javascript">
            "use strict";
            var whatsapp_popup = <?php echo e($userBs->whatsapp_popup); ?>;
            var whatsappImg = "<?php echo e(asset('assets/front/img/whatsapp.svg')); ?>";
            $(function() {
                $('#WAButton').floatingWhatsApp({
                    phone: "<?php echo e($userBs->whatsapp_number); ?>", //WhatsApp Business phone number
                    headerTitle: "<?php echo e($userBs->whatsapp_header_title); ?>", //Popup Title
                    popupMessage: `<?php echo !empty($userBs->whatsapp_popup_message) ? nl2br($userBs->whatsapp_popup_message) : ''; ?>`, //Popup Message
                    showPopup: whatsapp_popup == 1 ? true : false, //Enables popup display
                    buttonImage: '<img src="' + whatsappImg + '" />', //Button Image
                    position: "right" //Position: left | right

                });
            });
        </script>
    <?php endif; ?>

    <?php if($userBs->is_tawkto == 1): ?>
        <!--Start of Tawk.to Script-->
        <?php
            $directLink = str_replace('tawk.to', 'embed.tawk.to', $userBs->tawkto_direct_chat_link);
            $directLink = str_replace('chat/', '', $directLink);
        ?>
        <script type="text/javascript">
            "use strict";
            var Tawk_API = Tawk_API || {},
                Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement("script"),
                    s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = '<?php echo e($directLink); ?>';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script>

        <!--End of Tawk.to Script-->
    <?php endif; ?>

</body>

</html>
<?php /**PATH /var/www/html/saas/resources/views/user-front/layout.blade.php ENDPATH**/ ?>