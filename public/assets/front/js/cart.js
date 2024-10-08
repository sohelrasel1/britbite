"use strict";

var pprice = 0.00;
toastr.options.closeButton = true;
var $voptions;
function totalPrice(qty) {
    qty = qty.toString().length > 0 ? qty : 0;
    let $addons = $("input[name='addons']:checked");


    $voptions = $("input.voptions:checked");
    let vprice = 0;
    if ($voptions.length > 0) {
        $voptions.each(function () {
            vprice = parseFloat(vprice) + parseFloat($(this).data('price'));
        });
    }

    let total = parseFloat(pprice) + parseFloat(vprice);

    if ($addons.length > 0) {
        $addons.each(function () {
            total += parseFloat($(this).data('price'));
        });
    }

    total = total.toFixed(2) * parseInt(qty);

    if ($("#productPrice").length > 0) {
        $("#productPrice").html(total.toFixed(2));
    }

    return total.toFixed(2);
}

function addToCart(url, variant, qty, addons) {
    
    let cartUrl = url;
    // button disabled & loader activate (only for modal add to cart button)
    $(".modal-cart-link").addClass('disabled');
    $(".modal-cart-link span").removeClass('d-block');
    $(".modal-cart-link span").addClass('d-none');
    $(".modal-cart-link i").removeClass('d-none');
    $(".modal-cart-link i").addClass('d-inline-block');
    $.get(cartUrl + ',,,' + qty + ',,,' + totalPrice(qty) + ',,,' + JSON.stringify(variant) + ',,,' + JSON.stringify(addons), function (res) {
        // button enabled & loader deactivate (only for modal add to cart button)
        $(".modal-cart-link").removeClass('disabled');
        $(".modal-cart-link span").removeClass('d-none');
        $(".modal-cart-link span").addClass('d-block');
        $(".modal-cart-link i").removeClass('d-inline-block');
        $(".modal-cart-link i").addClass('d-none');

        if (res.message) {
            
            $(" body #cartQuantity").load(location.href + " #cartQuantity", function(){
                $(".request-loader").removeClass("show");
                $('#variationModal').modal('hide')
            });
            toastr["success"](res.message);
        } else {
            $(".request-loader").removeClass("show");

            toastr["error"](res.error);
        }
    });
}

(function ($) {
    "use strict";
    // ============== add to cart js start =======================//
    $(".cart-link").on('click', function (e) {
        e.preventDefault();
        let product = $(this).data('product');
       
        let variations = JSON.parse(product.variations);
        let addons = JSON.parse(product.addons);
        let keywords = JSON.parse(product.keywords);
        let addonkeywords = JSON.parse(product.addon_keywords);

        // set product current price
        pprice = product.current_price;

        // clear all previously loaded variations & addon input radio & checkboxes 
        $(".variation-label").addClass("d-none");
        $("#variants").html("");
        $(".addon-label").addClass("d-none");
        $("#addons").html("");

        // load variants & addons in modal if variations or addons available for this item
        if ((variations && variations?.length !== 0) || (addons && addons?.length !== 0)) {
            $("#variationModal").modal('show');

            // set modal title & quantity
            $("#variationModal .modal-title > span").html(product.title.substring(0, 67) + "...");
            $("input[name='cart-amount']").val(1);



            if (variations && variations?.length !== 0) {
                $(".variation-label").removeClass("d-none");
                let variationLength = Object.keys(variations).length;

                // load variations radio button input fields
                let variants = ``;
                let iopt = 0;
                for (var key in variations) {

                    let vname
                    if (sessionLang !== '') {
                        vname = sessionLang + '_' + key.replace("_", " ")
                    } else {
                        vname = currentLang + '_' + key.replace("_", " ")
                    }

                    variants += `<div class="variation-label">
                        <h5 class='text-capitalize'>${select} ${keywords['variation_name'][vname]} **</h5>
                    </div>`;

                    let options = variations[key];
                   
                    for (let i = 0; i < options.length; i++) {

                        let voption
                        if (sessionLang !== '') {
                            voption = sessionLang + '_' + options[i].name
                        } else {
                            voption = currentLang + '_' + options[i].name
                        }

                        variants += `<div class="form-check d-flex justify-content-between ${(i == (options.length - 1)) ? 'border-0' : ''}">
                            <div>
                                <input class="form-check-input voptions" type="radio" name="${key}_variant" id="voption${iopt}" value="" data-option="${key}" data-name="${options[i].name}" data-price="${options[i].price}" ${i == 0 ? 'checked' : ''}>
                                <label class="form-check-label" for="voption${iopt}">${keywords['option_name'][voption]}</label>
                            </div>
                            <span>
                                + ${textPosition == 'left' ? currText : ''} ${options[i].price} ${textPosition == 'right' ? currText : ''}
                            </span>
                        </div>`;
                        iopt++;
                    }
                }

                $("#variants").html(variants);
                // add margin top if variations available
                $(".addon-label").addClass('mt-3');
            } else {
                $(".addon-label").removeClass('mt-3');
            }

            if (addons && addons?.length !== 0) {
                $(".addon-label").removeClass("d-none");
                // load addons checkbox input fields
                let addonHtml = ``;
                for (let i = 0; i < addons.length; i++) {

                    let aname
                    if (sessionLang !== '') {
                        aname = sessionLang + '_' + addons[i].name
                    } else {

                        aname = currentLang + '_' + addons[i].name
                    }

                    addonHtml += `<div class="form-check d-flex justify-content-between">
                        <div>
                            <input class="form-check-input" type="checkbox" name="addons" id="addon${i}" value="${addons[i].name}" data-price="${addons[i].price.toFixed(2)}">
                            <label class="form-check-label" for="addon${i}">
                            ${addonkeywords['addon_name'][aname]}
                            </label>
                        </div>
                        <span>
                            + ${textPosition == 'left' ? currText : ''} ${addons[i].price} ${textPosition == 'right' ? currText : ''}
                        </span>
                    </div>`
                }
                $("#addons").html(addonHtml);
            }

            // set modal price
            totalPrice(1)

            $(".modal-cart-link").attr('data-product_id', product.product_id);

        } else {
            $(".request-loader").addClass("show");

            let $this = $(this);
            let url = $this.attr('data-href');
            let qty = $("#detailsQuantity").length > 0 ? $("#detailsQuantity").val() : 1;

            addToCart(url, "", qty, "");
        }

    });

    // ============== add to cart js end =======================//

    // ============== variation modal add to cart start =======================//
    $(document).on('click', '.modal-cart-link', function () {
        $(".request-loader").addClass("show");
        let $voptions = $("input.voptions:checked");

        let variant = {};
        let v_op_name = ''
        let v_op_price = ''
        for (let i = 0; i < $voptions.length; i++) {
            variant[$voptions.eq(i).data('option')] = {
                'name': $voptions.eq(i).data('name'),
                'price': $voptions.eq(i).data('price')
            };

        }


        let variantName = $("input[name='variant']:checked").val();
        let variantPrice = $("input[name='variant']:checked").data('price');
        let qty = $("input[name='cart-amount']").val();
        let pid = $(this).attr('data-product_id');
        let url = userCheckoutUrl?.replace(':id', pid);

        variant = variant;

        let $addons = $("input[name='addons']:checked");
        let addons = [];
        if ($addons.length > 0) {
            $addons.each(function () {
                addons.push({ name: $(this).val(), price: $(this).data('price') });
            });
        }

        addons = addons.length > 0 ? addons : "";
        qty = qty.length > 0 ? parseInt(qty) : 0;

        addToCart(url, variant, qty, addons);
    });
    // ============== variation modal add to cart end =======================//


    // ============== modal quantity add / substruct =======================//
    $(document).on("click", ".modal-quantity .plus", function () {
        let $input = $(".modal-quantity input");
        let currval = parseInt($input.val());

        let newval = currval + 1;
        $input.val(newval);
        totalPrice(newval);
    });
    $(document).on("click", ".modal-quantity .minus", function () {
        let $input = $(".modal-quantity input");
        let currval = parseInt($input.val());

        if (currval > 1) {
            let newval = currval - 1;
            $input.val(newval);
            totalPrice(newval);
        }
    });
    // ============== modal quantity add / substruct =======================// 


    // ============== variant change js start =======================//
    $(document).on('change', '#variants input', function () {
        totalPrice($("input[name='cart-amount']").val());
    });
    // ============== variant change js end =======================//


    // ============== addon change js start =======================//
    $(document).on('change', '#addons input', function () {
        totalPrice($("input[name='cart-amount']").val());
    });
    // ============== addon change js end =======================//


    // ============== addon change js start =======================//
    $(document).on('input', "input[name='cart-amount']", function () {
        totalPrice($("input[name='cart-amount']").val());
    });
    // ============== addon change js end =======================//


    //=============== cart update js start ==========================//

    $(document).on('click', '#cartUpdate', function () {
        $(".request-loader").addClass("show");
        let cartqty = [];
        let cartprice = [];
        let cartproduct = [];
        let cartUpdateUrl = $(this).attr('data-href');

        $(".cart_qty").each(function () {
            cartqty.push($(this).val());
        })

        let formData = new FormData();
        let i = 0;
        for (i = 0; i < cartqty.length; i++) {
            formData.append('qty[]', cartqty[i]);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: cartUpdateUrl,
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.message) {
                    $("#refreshDiv").load(location.href + " #refreshDiv",function(){
                        $("#cartQuantity").load(location.href + " #cartQuantity",function(){

                            $(".request-loader").removeClass("show");
                            toastr["success"](data.message);
                        });
                    });
                } else {
                    toastr["error"](data.error);
                }

            }
        });
    })


    //================= cart update js end ==========================//

    // ================ cart item remove js start =======================//

    $(document).on('click', '.item-remove', function () {
        $(".request-loader").addClass("show");
        let removeItemUrl = $(this).attr('data-href');
        $.get(removeItemUrl, function (res) {
            if (res.message) {
                $(" body #refreshDiv").load(location.href + " #refreshDiv",function(){
                    $("body #cartQuantity").load(location.href + " #cartQuantity",function(){
                        $(".request-loader").removeClass("show");
                    });
                });
                toastr["success"](res.message);
            } else {
                $(".request-loader").removeClass("show");
                toastr["error"](res.error);
            }

        });
    });


    // ================ cart item remove js end =======================//
    $(document).on('click', '.quantity', function () {
        $(".request-loader").addClass("show");
        let inputField = $(this).siblings('.cart_qty');
        let quantityUrl = $(this).data('href');
        let cart_qty = inputField.val();
        let btnId = this.id;  

        if (btnId === 'sub' && cart_qty <= 1) {
            $(".request-loader").removeClass("show");
            toastr["error"]("Quantity must be minimum 1");
            return; 
        }

        $.get(quantityUrl, function (res) {
            if (res.message) {
                $("#refreshDiv").load(location.href + " #refreshDiv", function () {
                    $("#cartQuantity").load(location.href + " #cartQuantity", function () {
                        $(".request-loader").removeClass("show");
                        toastr["success"](res.message);
                    });
                });
            } else {
                toastr["error"](res.error);
            }
        });
    });



    $('.addclick').on('click', function () {
        let orderamount = $('#detailsQuantity').val();
        $('#order_click_with_qty').val(orderamount);
    });
    $('.subclick').on('click', function () {
        let orderamount = $('#detailsQuantity').val();
        $('#order_click_with_qty').val(orderamount);
    });
}(jQuery));
