<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;

?>


<?php if(!empty($data->language) && $data->language->rtl == 1): ?>
    <?php $__env->startSection('styles'); ?>
        <style>
            form input,
            form textarea,
            form select {
                direction: rtl;
            }

            form .note-editor.note-frame .note-editing-area .note-editable {
                direction: rtl;
                text-align: right;
            }
        </style>
    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>

    <div class="page-header">
        <h4 class="page-title">Edit Item</h4>
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
                <a href="#">Items Management</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Edit Item</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-inline-block">Edit Item</div>
                    <a class="btn btn-info btn-sm float-right d-inline-block"
                        href="<?php echo e(route('user.product.index') . '?language=' . request()->input('language')); ?>">
                        <span class="btn-label">
                            <i class="fas fa-backward"></i>
                        </span>
                        Back
                    </a>
                </div>
                <div class="card-body pt-5 pb-5">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="alert alert-danger pb-1 dis-none" id="blogErrors">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <ul></ul>
                            </div>

                            <div>
                                <label for="" class="mb-2"><strong>Slider Images **</strong></label>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-striped" id="imgtable">

                                        </table>
                                    </div>
                                </div>
                                <form action="<?php echo e(route('user.product.slider.update')); ?>" id="my-dropzone"
                                    enctype="multipart/form-data" class="dropzone">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="product_id" value="<?php echo e($data->id); ?>">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple />
                                    </div>
                                </form>
                                <p class="em text-danger mb-0" id="errslider_images"></p>
                            </div>

                            <form id="blogForm" class="" action="<?php echo e(route('user.product.update')); ?>" method="post"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="product_id" value="<?php echo e($data->id); ?>">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group px-0">
                                            <div class="mb-2">
                                                <label for="image"><strong>Featured Image</strong></label>
                                            </div>
                                            <div class="showImage mb-3">
                                                <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_FEATURED_IMAGE, $data->feature_image, $userBs)); ?>"
                                                    alt="..." class="img-thumbnail" width="200">
                                            </div>
                                            <input type="file" name="feature_image" id="image"
                                                class="form-control image">
                                        </div>
                                    </div>
                                </div>
                                <div id="sliders"></div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group px-0">
                                            <label for="">Status **</label>
                                            <select class="form-control ltr" name="status">
                                                <option value="" selected disabled>Select a status</option>
                                                <option value="1" <?php echo e($data->status == 1 ? 'selected' : ''); ?>>Show
                                                </option>
                                                <option value="0" <?php echo e($data->status == 0 ? 'selected' : ''); ?>>Hide
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group px-0">
                                            <label for=""> Current Price
                                                (<?php echo e($userBe->base_currency_text); ?>)**</label>
                                            <input type="text" class="form-control ltr" name="current_price"
                                                value="<?php echo e($data->current_price); ?>" placeholder="Enter Current Price">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group px-0">
                                            <label for="">Previous Price
                                                (<?php echo e($userBe->base_currency_text); ?>)</label>
                                            <input type="text" class="form-control ltr" name="previous_price"
                                                value="<?php echo e($data->previous_price); ?>" placeholder="Enter Previous Price">
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion accordion-secondary mt-3" id="accordion">

                                    <?php $__currentLoopData = $userLangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $productData = $language
                                                ->productInformation()
                                                ->where('product_id', $data->id)
                                                ->first();
                                        ?>

                                        <div class="card">
                                            <div class="card-header <?php echo e($language->is_default == 1 ? '' : 'collapsed'); ?>" id="heading<?php echo e($language->id); ?>" data-toggle="collapse"
                                                data-target="#collapse<?php echo e($language->id); ?>"
                                                aria-expanded="<?php echo e($language->is_default == 1 ? 'true' : 'false'); ?>"
                                                aria-controls="collapse<?php echo e($language->id); ?>">
                                                <div class="span-title">
                                                    <?php echo e($language->name . __(' Language')); ?>

                                                    <?php echo e($language->is_default == 1 ? '(Default)' : ''); ?>

                                                </div>
                                                <div class="span-mode"></div>
                                            </div>

                                            <div id="collapse<?php echo e($language->id); ?>"
                                                class="collapse <?php echo e($language->is_default == 1 ? 'show' : ''); ?>"
                                                aria-labelledby="heading<?php echo e($language->id); ?>" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div
                                                                class="form-group <?php echo e($language->rtl == 1 ? 'rtl text-right' : ''); ?>">
                                                                <label><?php echo e(__('Title') . '*'); ?></label>
                                                                <input type="text" class="form-control"
                                                                    name="<?php echo e($language->code); ?>_title"
                                                                    placeholder="Enter Title"
                                                                    value="<?php echo e(is_null($productData) ? '' : $productData->title); ?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div
                                                                class="form-group <?php echo e($language->rtl == 1 ? 'rtl text-right' : ''); ?>">
                                                                <?php
                                                                    $categories = DB::table('pcategories')
                                                                        ->where('language_id', $language->id)
                                                                        ->where('user_id', Auth::guard('web')->user()->id)
                                                                        ->where('status', 1)
                                                                        ->orderByDesc('id')
                                                                        ->get();
                                                                ?>
                                                                <label for=""><?php echo e(__('Category') . '*'); ?></label>
                                                                <select name="<?php echo e($language->code); ?>_category_id"
                                                                    class="form-control"
                                                                    id="<?php echo e($language->id); ?>_category_id"
                                                                    onchange="getSubCategory(this)">
                                                                    <?php if(!empty($categories)): ?>
                                                                        <option disabled><?php echo e(__('Select Category')); ?>

                                                                        </option>
                                                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($category->id); ?>"
                                                                                <?php echo e(!empty($productData) && $productData->category_id == $category->id ? 'selected' : ''); ?>>
                                                                                <?php echo e($category->name); ?>

                                                                            </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">

                                                            <div
                                                                class="form-group <?php echo e($language->rtl == 1 ? 'rtl text-right' : ''); ?>">
                                                                <?php
                                                                    $subcategories = DB::table('psub_categories')
                                                                        ->where('language_id', $language->id)
                                                                        ->where('category_id', $productData?->category_id)
                                                                        ->where('user_id', Auth::guard('web')->user()->id)
                                                                        ->where('status', 1)
                                                                        ->orderByDesc('id')
                                                                        ->get();
                                                                ?>
                                                                <label for=""><?php echo e(__('Subcategory')); ?></label>
                                                                <select name="<?php echo e($language->code); ?>_subcategory_id"
                                                                    class="form-control"
                                                                    id="<?php echo e($language->id); ?>_subcategory_id">
                                                                    <?php if(!empty($subcategories)): ?>
                                                                        <option selected value="<?php echo e(null); ?>"><?php echo e(__('Select Subcategory')); ?>

                                                                        </option>
                                                                        <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($subcategory->id); ?>"
                                                                                <?php echo e(!empty($productData) && $productData->subcategory_id == $subcategory->id ? 'selected' : ''); ?>>
                                                                                <?php echo e($subcategory->name); ?>

                                                                            </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div
                                                                class="form-group <?php echo e($language->rtl == 1 ? 'rtl text-right' : ''); ?>">
                                                                <label><?php echo e(__('Summary') . '*'); ?></label>
                                                                <textarea row="6" type="text" class="form-control"
                                                                    name="<?php echo e($language->code); ?>_summary"
                                                                    placeholder="Enter Product Summary"
                                                                    ><?php echo e($productData?->summary); ?>

                                                                </textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div
                                                                class="form-group <?php echo e($language->rtl == 1 ? 'rtl text-right' : ''); ?>">
                                                                <label><?php echo e(__('Description') . '*'); ?></label>
                                                                <textarea class="form-control summernote" id="description<?php echo e($language->code); ?>" name="<?php echo e($language->code); ?>_description" placeholder="Enter Description"
                                                                    data-height="300"><?php echo e(is_null($productData) ? '' : replaceBaseUrl($productData?->description, 'summernote')); ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div
                                                                class="form-group <?php echo e($language->rtl == 1 ? 'rtl text-right' : ''); ?>">
                                                                <label><?php echo e(__('Meta Keywords')); ?></label>
                                                                <input class="form-control"
                                                                    name="<?php echo e($language->code); ?>_meta_keywords"
                                                                    placeholder="Enter Meta Keywords"
                                                                    data-role="tagsinput"
                                                                    value="<?php echo e(is_null($productData) ? '' : $productData->meta_keywords); ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div
                                                                class="form-group <?php echo e($language->rtl == 1 ? 'rtl text-right' : ''); ?>">
                                                                <label><?php echo e(__('Meta Description')); ?></label>
                                                                <textarea class="form-control" name="<?php echo e($language->code); ?>_meta_description" rows="5"
                                                                    placeholder="Enter Meta Description"><?php echo e(is_null($productData) ? '' : $productData->meta_description); ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                <div class="js-repeater">
                                    <div class="mb-3">
                                        <label class="form-label mb-2">Variations</label>
                                        <br>
                                        <button class="btn btn-primary  js-repeater-add" type="button">+
                                            Add Variant</button>
                                    </div>
                                    <div id="js-repeater-container">
                                        <?php
                                            $variations = json_decode($data->variations, true);
                                            $keywords = json_decode($data->keywords, true);
                                            $addonkeywords = json_decode($data->addon_keywords, true);
                                            $addons = json_decode($data->addons, true);

                                            $indx = json_decode($data->indx, true);
                                        ?>

                                        <?php if(!empty($variations)): ?>
                                            <?php
                                                $v = -1;
                                            ?>
                                            <?php $__currentLoopData = $variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vkey => $vname): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $v++;
                                                ?>

                                                <div class="js-repeater-item" data-item="<?php echo e($v); ?>">
                                                    <div class="mb-3 row align-items-end">
                                                        <?php $__currentLoopData = $userLangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lkey => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $key = $lang->code . '_' . $vkey;
                                                            ?>

                                                            <div class="col-3">
                                                                <label for="form" class="form-label mb-1">Variation
                                                                    Name (<?php echo e($lang->code); ?>)</label>
                                                                <div class=" mb-2">


                                                                    <input type="text" required=""
                                                                        value="<?php echo e($keywords['variation_name'][$key] ?? ''); ?>"
                                                                        class="form-control" placeholder=""
                                                                        name="<?php echo e($lang->code); ?>_variation_<?php echo e($v); ?>">

                                                                    <input type="hidden" name="variation_helper[]"
                                                                        value="<?php echo e($v); ?>">
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <button class="btn btn-danger btn-sm js-repeater-remove mb-2 mr-2"
                                                            type="button"
                                                            onclick="$(this).parents('.js-repeater-item').remove()">X</button>
                                                        <button class="btn btn-success btn-sm js-repeater-child-add mb-2"
                                                            type="button" data-it="<?php echo e($v); ?>">
                                                            Add Option
                                                        </button>

                                                        <div class="repeater-child-list mt-2 col-12" id="options<?php echo e($v); ?>">

                                                             <?php $__currentLoopData = $variations[$vkey]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $okey => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                            <div class="repeater-child-item mb-3" id="options<?php echo e($v .$okey); ?>">
                                                                <div class="row align-items-start">

                                                                    <?php $__currentLoopData = $userLangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lkey => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                     <?php
                                                                        $optionK = $lang->code.'_'.$option['name']
                                                                    ?>

                                                                    <div class="col-2 ">
                                                                        <label for="form"
                                                                            class="form-label mb-1">Option Name (<?php echo e($lang->code); ?>)</label>

                                                                        <input required name="<?php echo e($lang->code); ?>_options1_<?php echo e($v); ?>[]"
                                                                            type="text" class="form-control"
                                                                            placeholder="" value="<?php echo e($keywords['option_name'][$optionK] ?? ''); ?>">

                                                                    </div>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                                    <div class="col-2 ">
                                                                        <label for="form"
                                                                            class="form-label mb-1">Price (<?php echo e($userBe->base_currency_symbol); ?>)</label>
                                                                        <input required name="options2_<?php echo e($v); ?>[]"
                                                                            type="number" class="form-control"
                                                                            value="<?php echo e($variations[$vkey][$okey]['price']); ?>" placeholder="0">

                                                                    </div>

                                                                    <div class="col-2">
                                                                        <button
                                                                            class="btn btn-danger js-repeater-child-remove btn-sm"
                                                                            type="button"
                                                                            onclick="$(this).parents('.repeater-child-item').remove()">X</button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <?php endif; ?>

                                </div>

                                <div class="js-repeater-addon">
                                    <div class="mb-3">
                                        <label class="form-label mb-2">Addons</label>
                                        <br>
                                        <button class="btn btn-primary  js-repeater-addon-add" type="button">+
                                            Add Addon</button>
                                    </div>
                                    <div id="js-repeater-container-addon">

                                        <?php if(!empty($addonkeywords)): ?>
                                            <?php
                                                $a = -1;
                                            ?>
                                            <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akey => $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $a++;
                                                ?>
                                                <div class=" mb-3 js-repeater-item js-repeater-item-addon "
                                                    id="addonDiv<?php echo e($a); ?>">
                                                    <div class="mb-3 row align-items-end">
                                                        <?php $__currentLoopData = $userLangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lkey => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $key = $lang->code . '_' . $addon['name'];
                                                            ?>

                                                            <div class="col-3">
                                                                <label for="form" class="form-label mb-1">Addon Name
                                                                    (In <?php echo e($lang->code); ?>)</label>
                                                                <div class="mb-2">

                                                                    <input required
                                                                        value="<?php echo e($addonkeywords['addon_name'][$key] ?? ''); ?>"
                                                                        name="<?php echo e($lang->code); ?>_addonoptions1_<?php echo e($a); ?>[]"
                                                                        type="text" class="form-control"
                                                                        placeholder="">

                                                                    <input type="hidden" name="addon_variation_helper[]"
                                                                        value="<?php echo e($a); ?>">
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-2 ">
                                                            <label for="form" class="form-label mb-1">Price
                                                                (<?php echo e($userBe->base_currency_symbol); ?>)</label>
                                                            <div class="mb-2">
                                                                <input required
                                                                    name="addonoptions2_<?php echo e($a); ?>[]"
                                                                    type="number" class="form-control"
                                                                    value="<?php echo e($addon['price']); ?>" placeholder="0">
                                                            </div>
                                                        </div>

                                                        <div class="col-2">
                                                            <button
                                                                class="btn btn-danger mb-2 js-repeater-child-remove btn-sm"
                                                                type="button"
                                                                onclick="$(this).parents('.js-repeater-item-addon').remove()">X</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form">
                        <div class="form-group from-show-notify row">
                            <div class="col-12 text-center">
                                <button type="submit" form="blogForm" class="btn btn-success">
                                    <?php echo e(__('Update')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('variables'); ?>
    <script>
        "use strict";
        var storeUrl = "<?php echo e(route('user.product.slider.store')); ?>";
        var removeUrl = "<?php echo e(route('user.product.slider.rmv')); ?>";
        var rmvdbUrl = "<?php echo e(route('user.product.slider.rmv')); ?>";
        var loadImgs = "<?php echo e(route('user.product.images', $data->id)); ?>";
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        const languages = <?= $userLangs ?>;
        let symbol = "<?php echo e($userBe->base_currency_symbol); ?>";
        let variants = [];
        let variantRoute = "<?php echo e(route('user.product.variants', $data->id)); ?>";
        let addonRoute = "<?php echo e(route('user.product.addons', $data->id)); ?>";

    </script>
    <script type="text/javascript" src="<?php echo e(asset('assets/tenant/js/partial.js')); ?>"></script>
    <script  src="<?php echo e(asset('assets/tenant/js/product-edit.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\BritBite-Company-England\britbite-git\britbite\resources\views/user/product/edit.blade.php ENDPATH**/ ?>