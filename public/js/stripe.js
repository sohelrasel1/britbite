"use strict";

$(document).ready(function () {
    $('#stripe-element').addClass('d-none');
})


/**
 * show or hide stripe gateway input fields,
 * also show or hide offline gateway informations according to checked payment gateway
 */
$('#payment-gateway').on('change', function () {

    let value = $(this).val();

    let dataType = parseInt(value);
    if (isNaN(dataType)) {
        // show or hide stripe card inputs
        if (value == 'stripe' || value == 'Stripe') {
            $('#stripe-element').removeClass('d-none');
        } else {
            $('#stripe-element').addClass('d-none');
        }
    } else {
        // hide stripe gateway card inputs
        if (!$('#stripe-element').hasClass('d-none')) {
            $('#stripe-element').addClass('d-none');
            $('#stripe-element').removeClass('d-block');
        }
    }
});


// Set your Stripe public key
var stripe = Stripe(stripe_key);

// Create a Stripe Element for the card field
var elements = stripe.elements();
var cardElement = elements.create('card', {
    style: {
        base: {
            iconColor: '#454545',
            color: '#454545',
            fontWeight: '500',
            lineHeight: '50px',
            fontSmoothing: 'antialiased',
            backgroundColor: '#f2f2f2',
            ':-webkit-autofill': {
                color: '#454545',
            },
            '::placeholder': {
                color: '#454545',
            },
        }
    },
});

// Add an instance of the card Element into the `card-element` div
cardElement.mount('#stripe-element');

// Handle form submission

// Select multiple form elements with different IDs
var form = document.getElementById("my-checkout-form");

// Loop through the NodeList and add event listener to each form element
form.addEventListener('submit', function (event) {
    
    $("button[type=submit]").text('Processing..').prop('disabled', true);
    var payment_gateway = $('.selected-payment-gateway').val();
    event.preventDefault();
    if (payment_gateway == 'Stripe' || payment_gateway == 'stripe') {
        stripe.createToken(cardElement).then(function (result) {
            if (result.error) {
                // Display errors to the customer
                var errorElement = document.getElementById('stripe-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server
                stripeTokenHandler(result.token);
            }
        });
    } else if (payment_gateway == 'Authorize.net') {
        sendPaymentDataToAnet();
    }
    else {
        
        document.getElementById('my-checkout-form').submit()
    }
});




// Send the token to your server
function stripeTokenHandler(token) {
    // Add the token to the form data before submitting to the server
    var form = document.getElementById("my-checkout-form");
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form to your server
    form.submit();
}


//authorize.net start
function sendPaymentDataToAnet() {
    // Set up authorisation to access the gateway.
    var authData = {};
    authData.clientKey = anit_public_key;
    authData.apiLoginID = login_id;

    var cardData = {};
    cardData.cardNumber = document.getElementById("anetCardNumber").value;
    cardData.month = document.getElementById("anetExpMonth").value;
    cardData.year = document.getElementById("anetExpYear").value;
    cardData.cardCode = document.getElementById("anetCardCode").value;

    // Now send the card data to the gateway for tokenisation.
    // The responseHandler function will handle the response.
    var secureData = {};
    secureData.authData = authData;
    secureData.cardData = cardData;
    Accept.dispatchData(secureData, responseHandler);
}

function responseHandler(response) {
    if (response.messages.resultCode === "Error") {
        var i = 0;
        let errorLists = ``;
        while (i < response.messages.message.length) {
           
            errorLists += `<li class="text-danger">${response.messages.message[i].text}</li>`;

            i = i + 1;
        }
        $("#anetErrors").show();
        $("#anetErrors").html(errorLists);
    } else {
        paymentFormUpdate(response.opaqueData);
    }
}

function paymentFormUpdate(opaqueData) {
    document.getElementById("opaqueDataDescriptor").value = opaqueData.dataDescriptor;
    document.getElementById("opaqueDataValue").value = opaqueData.dataValue;
    document.getElementById("my-checkout-form").submit();
}
//authorize.net start end
