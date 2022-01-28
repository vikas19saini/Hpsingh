/*header fixed */
$(window).scroll(function () {
    if ($(window).width() >= 767) {
        if ($(this).scrollTop() > 0) {
            $('body').addClass("header-fixed");
        } else {
            $('body').removeClass("header-fixed");
        }
    }
});

/*mobile header fixed */
$(window).scroll(function () {
    if ($(window).width() <= 767) {
        if ($(this).scrollTop() > 2) {
            $('body').addClass("header-fixed");
        } else {
            $('body').removeClass("header-fixed");
        }
    }
});

/* footer mobile */
$(document).ready(function () {
    $('.accordion').find('.accordion-toggle').click(function () {
        $(this).next().slideToggle('600');
        $(".accordion-content").not($(this).next()).slideUp('600');
    });
    $('.accordion-toggle').on('click', function () {
        $(this).toggleClass('active').siblings().removeClass('active');
    });

    //Mobile Menu
    $(".logo>span").click(function () {
        $(".mobile_header_menu").toggleClass('active');
    });

    $(".mobile_hidden_vissible").click(function () {
        $(".mobile_header_menu").removeClass('active');
    });


    $('.favric_icon').click(function () {
        $(this).next().slideToggle('600');
        $(".moblie_item_visible").not($(this).next()).slideUp('600');
    });
    $('.favric_icon').on('click', function () {
        $('.favric_icon').removeClass('active').siblings('a').css({ 'color': '#555' });
        $(this).addClass('active').siblings('a').css({ 'color': '#ff9d3a' });
    });
    //Get cart items on load
    getCartItems();

    //Display tooltip
    $('[data-toggle="tooltip"]').tooltip();
});

function flashMessage(flash) {
    var pclass, iclass;
    $(".effectBounceInDown").remove();
    if (flash.status === 'error') {
        iclass = 'fa fa-exclamation-triangle';
        pclass = 'effectBounceInDown flash-error';
    }

    if (flash.status === 'success') {
        iclass = 'fa fa-info-circle';
        pclass = 'effectBounceInDown flash-success';
    }

    $('body').append(`<p class="${pclass}"><span> <i class="${iclass}"></i></span> <span>${flash.message}</span>`);

    $(".effectBounceInDown").delay(5000).fadeOut("slow", function () {
        $(this).remove();
    });
}

function addToCart(slug, ref) {
    var __inputEle = $('input[data-slug=' + slug + ']');
    var __qty = __inputEle.val();
    $.ajax({
        url: HOST + "cart/add",
        type: 'POST',
        data: { "slug": slug, 'qty': __qty },
        beforeSend: function (xhr) {
            xhr.setRequestHeader('X-CSRF-Token', _csrfToken);
            $(ref).append('<i class="y9uHb"></i>');
        },
        success: function (response) {
            //gtag_report_conversion();
            flashMessage(response);
            getCartItems();
            $(ref).children('i').remove();
            dataLayerAddToCart(ref, __qty);
        }
    });
}

function getCartItems() {
    $.ajax({
        url: HOST + "cart/getCartItems",
        type: 'GET',
        success: function (response) {
            if (response === null) {
                return;
            }

            if (response.totalItems !== 0) {
                $("#cartItems").text(response.totalItems);
            } else {
                $("#cartItems").text('');
            }
        }
    });
}

function getProductsInCart() {
    $.ajax({
        url: HOST + 'cart/getCartProducts',
        type: 'GET',
        beforeSend: function () {
            $("#cartProducts").addClass('dis-ele');
        },
        success(response) {
            $("#cartProducts").children('section').remove();
            $("#cartProducts").prepend(response);
            $("#cartProducts").removeClass('dis-ele');
        }
    });
}

function removeFromCart($pid, __ele) {
    $.ajax({
        url: HOST + 'cart/removeFromCart/' + $pid,
        type: 'GET',
        beforeSend: function (xhr) {
            $("#cartProducts").addClass('dis-ele');
        },
        success(response) {
            if (response.status === 'success') {
                getProductsInCart();
                getCartItems();
                dataLayerRemoveFromCart(__ele);
            }
        }
    });
}

$(document).on('click', '.add-to-wishlist', function () {
    var ref = $(this);
    $.ajax({
        url: $(this).attr('href'),
        type: 'GET',
        beforeSend: function (xhr) {
            ref.parent('button').append('<span class="y9uHb"></span>');
        },
        success: function (response) {
            ref.parent('button').children('.y9uHb').remove();
            flashMessage(response);
        },
        error: function (err) {
            if (err.status === 403) {
                flashMessage({
                    'status': 'error',
                    'message': 'Please login to add!'
                });
            }
        }
    });

    return false;
});

$(document).on('click', '.move-to-wishlist', function () {
    var ref = $(this);
    $.ajax({
        url: $(this).attr('href'),
        type: 'GET',
        beforeSend: function () {
            ref.append('<i class="y9uHb"></i>');
        },
        success: function (response) {
            if (response.status === 'success') {
                getCartItems();
                getProductsInCart();
            }
        },
        error: function (err) {
            ref.children('.y9uHb').remove();
            if (err.status === 403) {
                flashMessage({
                    'status': 'error',
                    'message': 'Please login to move!'
                });
            }
        }
    });
    return false;
});

function getWishlist() {
    $.ajax({
        url: HOST + 'wishlist/getItems',
        type: 'GET',
        beforeSend: function () {
            $("#wishlist").addClass('dis-ele');
        },
        success: function (response) {
            $("#wishlist").children('section').remove();
            $("#wishlist").prepend(response);
            $("#wishlist").removeClass('dis-ele');
        }
    });
}

function removeFromWishlist(wid) {
    $.ajax({
        url: HOST + 'wishlist/remove/' + wid,
        type: 'GET',
        beforeSend: function () {
            $("#wishlist").addClass('dis-ele');
        },
        success: function (response) {
            if (response.status === 'success')
                getWishlist();
        },
        error: function (err) {
            if (err.status === 403) {
                flashMessage({
                    'status': 'error',
                    'message': 'Please login to move!'
                });
            }
        }
    });
}

function decQuantity(ref) {
    var __inputEle = ref.nextElementSibling;
    var __min = Number(__inputEle.getAttribute('min'));
    var __step = Number(__inputEle.getAttribute('step'));
    var __val = Number(__inputEle.value);

    if (__val > __min) {
        __inputEle.setAttribute('value', Number(__val - __step).toFixed(1));
        __inputEle.value = Number(__val - __step).toFixed(1);
    } else {
        flashMessage({ 'status': 'error', 'message': 'The Minimum purchase quantity is : ' + __min });
    }
}

function incQuantity(ref) {
    var __inputEle = ref.previousElementSibling;
    var __max = Number(__inputEle.getAttribute('max'));
    var __step = Number(__inputEle.getAttribute('step'));
    var __val = Number(__inputEle.value);

    if (__val < __max) {
        __inputEle.setAttribute('value', Number(__val + __step).toFixed(1));
        __inputEle.value = Number(__val + __step).toFixed(1);
    } else {
        flashMessage({ 'status': 'error', 'message': 'The Maximum purchase quantity is : ' + __max });
    }
}



function moveToCart(slug, wid) {
    addToCart(slug);
    removeFromWishlist(wid);
    getCartItems();
}

function updateQuantity(pid, qty) {
    $.ajax({
        url: HOST + 'cart/updateQuantity/' + pid + '/' + qty,
        type: 'GET',
        beforeSend: function () {
            $("#cartProducts").addClass('dis-ele');
        },
        success: function (response) {
            if (response.status === 'success') {
                getProductsInCart();
            } else {
                flashMessage(response);
                $("#cartProducts").removeClass('dis-ele');
            }
        }
    });
}

function loadMore(url) {
    //window.location.href = url;
    //return;
    $.ajax({
        url: url,
        type: 'GET',
        beforeSend: function () {
            $("#currentPage").children('button').append('<i class="y9uHb"></i>');
        },
        success(response) {
            $("#archiveProducts").append(response);
            $("#currentPage").html($("#nextPage").html());
            $("#nextPage").remove();
        }
    });
}

function addAddress(ref, event) {

    event.preventDefault();

    $.ajax({
        url: HOST + "customer/addresses",
        type: 'POST',
        data: $(ref).serialize(),
        beforeSend: function () {
            addloader()
        },
        success: function (response) {
            removeLoader();
            if (response.status === 'success') {
                window.location.reload();
            } else {
                flashMessage(response);
            }
        }
    });
}

function addloader() {
    $('body').append('<div class="loading">&#8230;</div>');
}

function removeLoader() {
    $(".loading").remove();
}

function selectAddress(address_id, selected_for) {
    $.ajax({
        url: HOST + "cart/checkout",
        type: 'POST',
        data: {
            request_type: selected_for,
            selected_address: address_id,
            shipping_address: checkout.shipping_address,
            billing_address: checkout.billing_address,
            payment_method: checkout.payment_method,
        },
        beforeSend: function (xhr) {
            xhr.setRequestHeader('X-CSRF-Token', $('input[name=_csrfToken]').val());
            addloader();
        },
        success: function (response) {

            if (typeof (response) === 'object') {
                removeLoader();
                if (response.status === 'error') {
                    flashMessage(response);
                }
                return false;
            } else {
                $("#checkout").replaceWith(response);
                removeLoader();
            }

            if (selected_for === 'shipping_address') {
                $('html, body').animate({
                    scrollTop: $(".biling_add").offset().top - $('header')[0].offsetHeight
                }, 1000);

                step('billing');
            } else {
                $('html, body').animate({
                    scrollTop: $(".payment-method").offset().top - $('header')[0].offsetHeight
                }, 1000);
                step('payment');
            }

            $('[data-toggle="tooltip"]').tooltip();
        }
    });
}

function step(step_for) {
    var ref, step = '';

    if (step_for === 'billing') {
        ref = $('.step2');
        step = 'Step 3/4';
    }

    if (step_for === 'payment') {
        ref = $('.step3');
        step = 'Step 4/4';
    }

    if ($(window).width() <= 767) {
        $('.steps-mobile').children('span').text(step);
    } else {
        ref.addClass('active');
        ref.siblings().removeClass('active');
    }

}

$(document).on('click', '.change_shipping_address_button', function () {
    $(this).parent('.selected_shipping_address').css('display', 'none');
    $(this).parent('.selected_shipping_address').next('.shipping_section').removeClass('disabled');
});

function deleteAddress(address_id, ref) {
    $.ajax({
        url: HOST + "customer/deleteAddress/" + address_id,
        type: 'DELETE',
        beforeSend: function (xhr) {
            xhr.setRequestHeader('X-CSRF-Token', $('input[name=_csrfToken]').val());
            addloader();
        },
        success: function (data, textStatus, jqXHR) {
            if (data.status === 'success') {
                $(ref).parent('li').parent('ul').parent('div').parent('div').parent('div').remove();
            }
            removeLoader();
            flashMessage(data);
        }
    });
}

$(document).on('click', '.payment_method', function () {
    $(this).children('label').children('input[type=radio]').prop('checked', true);
    var ref = $(this);
    var payment_method = $(this).attr('data-value');
    checkout.payment_method = payment_method;

    $.ajax({
        url: HOST + "cart/getPaymentMethod/" + payment_method,
        type: 'GET',
        beforeSend: function (xhr) {
            addloader();
        },
        success: function (response) {
            $(".payment_details").remove();
            ref.after(response);
            removeLoader();
        }
    });
});

function placeorder() {
    if (checkout.billing_address == 0 || checkout.shipping_address == 0 || checkout.payment_method == 0) {
        flashMessage({ status: 'error', message: "Please provide shipping, billing & payment details." });
        return false;
    }

    checkout.gst = $('input[name=gst]').val();

    if (checkout.gst !== "") {
        if (checkout.gst.length > 15 || checkout.gst.length < 15) {
            flashMessage({ status: "error", message: "Invalid GST Number" });
            return false;
        }
    }

    $.ajax({
        url: HOST + "cart/placeorder",
        type: 'POST',
        data: Object.assign(checkout, { g_recaptcha_response: $("textarea[name=g-recaptcha-response]").val() }),
        beforeSend: function (xhr) {
            xhr.setRequestHeader('X-CSRF-Token', $('input[name=_csrfToken]').val());
            addloader();
        },
        success: function (response) {
            if (response.status === 'error') {
                removeLoader();
                flashMessage(response);
            } else {
                window.location.href = response.redirect_uri;
            }
        }
    });
}


// Settingup paypal;
function setup_paypal() {
    paypal.Buttons({
        createOrder: function (data, actions) {
            return fetch(HOST + 'cart/placeorder', {
                method: 'post',
                headers: new Headers({
                    'X-CSRF-Token': $('input[name=_csrfToken]').val(),
                    'Content-Type': 'application/json',
                }),
                body: JSON.stringify(checkout),
            }).then(function (res) {
                return res.json();
            }).then(function (response) {
                if (response.status === 'error') {
                    flashMessage(response);
                }
                return response.request.result.id;
            });
        },
        onApprove: function (data, actions) {
            addloader();
            return fetch(HOST + 'payments/validatePpaypalPayment/' + data.orderID, {
                method: 'get'
            }).then(function (res) {
                return res.json();
            }).then(function (details) {
                if (details.status === 'success') {
                    window.location.href = details.redirect_uri;
                } else if (details.status === 'error') {
                    removeLoader();
                    flashMessage(details);
                } else if (details.status === 'restart') {
                    removeLoader();
                    return actions.restart();
                }
            });
        },
        onCancel: function (data) {
            addloader();
            return fetch(HOST + 'payments/paypalPaymentCancel/' + data.orderID, {
                method: 'get',
            }).then(function (res) {
                return res.json();
            }).then(function (details) {
                removeLoader();
                flashMessage(details);
            });
        },
        onError: function (err) {
            flashMessage({ status: "error", message: "Oops something went wrong, Please try again!" });
        },
        style: {
            color: 'blue',
            shape: 'pill',
            label: 'pay',
            height: 40,
        }
    }).render('#paypal-button');
}

$(document).on('click', '#remove-coupon', function () {
    $.ajax({
        url: HOST + "cart/removeCoupon",
        type: 'GET',
        beforeSend: function (xhr) {
            addloader();
        },
        success: function (data, textStatus, jqXHR) {
            window.location.reload()
        }
    })
});

// Product search start

var timeout = null;

$(document).on('keyup', '#search-products, #mobile-search-products', function () {
    if ($(this).val().length <= 3) {
        $(".categories-list").css('display', 'block');
        $("#search-suggesions").css('display', 'none');
        return;
    }

    $(".categories-list").css('display', 'none');

    if (timeout !== null) {
        clearTimeout(timeout);
    }

    var ref = $(this);

    timeout = setTimeout(function () {
        $.ajax({
            url: HOST + "search/query/" + ref.val(),
            type: 'GET',
            beforeSend: function (xhr) {
                if ($(window).width() >= 767) {
                    $("#search-products").next('button').next('button').children('i').css('display', 'none');
                    $("#search-products").next('button').next('button').children('img').css('display', 'inline-block');
                } else {
                    ref.parent().parent().append('<span class="y9uHb"></span>');
                }
            },
            success: function (data, textStatus, jqXHR) {
                if ($(window).width() >= 767) {
                    $("#search-products").parent('li').find('#search-suggesions').remove();
                    $("#search-products").parent('li').append(data);
                    //$("#search-suggesions").html(data);
                    $("#search-products").next('button').children('i').css('display', 'inline-block');
                    $("#search-products").next('button').children('img').css('display', 'none');
                } else {
                    $(".mobile_search_window").find('#search-suggesions').remove();
                    $(".mobile_search_window").append(data);
                    ref.parent().parent().children('.y9uHb').remove();
                }
            }
        });
    }, 500);
});

$(".search-products span button").click(function () {
    window.location.href = HOST + 'search/' + $("#search-products").val();
});

$(document).on('keydown', '#search-products', function (e) {
    if (e.keyCode === 13) {
        window.location.href = HOST + 'search/' + $("#search-products").val();
    }
});

$(document).on('keydown', '#mobile-search-products', function (e) {
    if (e.keyCode === 13) {
        window.location.href = HOST + 'search/' + $(this).val();
    }
});

$(window).click(function () {
    $("#search-suggesions").remove();
});

// Product search end

function customerOrderAction(ref, action, order_id) {
    $.ajax({
        url: HOST + "orders/customerAction/" + order_id + '/' + action,
        type: 'GET',
        beforeSend: function (xhr) {
            $(ref).append('<span class="y9uHb"></span>');
        },
        success: function (data, textStatus, jqXHR) {
            $(ref).children('span').remove();
            flashMessage(data);
        }
    });
}

function subscribe(ref, event) {
    event.preventDefault();

    $.ajax({
        url: HOST + "pages/subscribe",
        type: 'POST',
        data: new FormData(ref),
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function (xhr) {
            $(ref).find('button').css('position', 'relative')
            $(ref).find('button').append('<span class="y9uHb"></span>');
        },
        success: function (response) {
            $(ref).find('button').children('span').remove();
            $(ref)[0].reset();
            flashMessage(response);
        }
    });
}

$(document).on('click', '#check-delivery', () => {

    var postcode = $('#delivery-postcode').val();
    var country_code = $('#delivery-country-code').val();
    var product_id = $("#delivery-product_id").val();

    if (postcode === '' || typeof postcode === 'undefined') {
        return false;
    }

    $.ajax({
        url: HOST + "product/checkDelivery/" + postcode + '/' + country_code + '/' + product_id,
        type: 'GET',
        beforeSend: function (xhr) {
            $("#check-delivery").append('<span class="y9uHb"></span>');
        },
        success: function (response) {
            if (response.status === 'success') {
                $(".delivery-details-display").html(`<p>Expected Delivery Time <span>${response.DeliveryDayOfWeek}, ${response.DeliveryDate} | Delivery Fee: <price>${response.DeliveryChargesText}</price>. Actual time may vary depending on other items in your order</span></p>`);
                if (response.hasOwnProperty('cod')) {
                    //$(".delivery-details-display").append(`<p>Cash/Card on delivery available</p>`);
                }
            } else {
                $(".delivery-details-display").text(response.message);
            }

            $(".delivery-details-display").css('display', 'block');
            $("#check-delivery").children('span').remove();
        }
    });
});

$(document).on('submit', '#apply-coupon-form', function (e) {
    e.preventDefault();

    $.ajax({
        url: HOST + "cart/apply-coupon",
        type: 'POST',
        data: new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function (xhr) {
            $('#apply-coupon-form').find('button').append('<i class="y9uHb"></i>');
        },
        success: function (response) {
            $('#apply-coupon-form').find('button').children('i').remove();

            if (response.status === 'error') {
                flashMessage(response);
                return;
            }
            addloader();
            window.location.reload();
        }
    });
});

$(document).on('click', "#speech_to_text_convert", function () {

    var _ele = $(this);

    try {
        var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        var recognition = new SpeechRecognition();
        var query = '';

        recognition.onstart = () => {
            _ele.prev().attr('placeholder', 'Listening...')
        };

        recognition.onspeechend = () => {
            _ele.prev().attr('placeholder', 'Search for products')
            _ele.prev().val(query);
            _ele.prev().trigger('change');
        };
        recognition.onerror = () => {
            _ele.prev().attr('placeholder', 'Search for products')
        };

        recognition.onresult = (event) => {
            var current = event.resultIndex;
            var transcript = event.results[current][0].transcript;
            query += transcript;
        };

        recognition.start();
    } catch (e) {
        _ele.prev().attr('placeholder', 'Search for products')
    }
});


// Infinite scroll

$(window).on('scrollll', function () {

    var elementTop = $("#currentPage").offset().top;
    var elementBottom = elementTop + $("#currentPage").outerHeight();

    var viewportTop = $(window).scrollTop();
    var viewportBottom = viewportTop + $(window).height();

    var inViewport = elementBottom > viewportTop && elementTop < viewportBottom;

    if (inViewport) {
        //$("#currentPage").children('button').trigger('click');
    }
});

$(document).on('change', 'select[name=country_id]', function () {

    var parentForm = $(this).closest('form');

    $.ajax({
        url: HOST + "customer/getStates/" + $(this).val(),
        type: 'GET',
        beforeSend: function (xhr) {
            parentForm.find('select[name=zone_id]').html('<option>Loading States..</option>');
        },
        success: function (response) {
            parentForm.find('select[name=zone_id]').html('');

            $.each(response, function (key, val) {
                parentForm.find('select[name=zone_id]').append(`<option value='${key}'>${val}</option>`);
            });
        }
    });
});

$(document).ready(function () {
    var sync1 = $("#sync1");
    var sync2 = $("#sync2");
    var slidesPerPage = 1;
    var syncedSecondary = true;

    sync1.owlCarousel({
        items: 1,
        slideTransition: 'linear',
        autoplayTimeout: 6000,
        autoplaySpeed: 6000,
        nav: false,
        autoplay: true,
        dots: false,
        loop: true,
        responsiveRefreshRate: 200,
        navText: ['', ''],
    }).on('changed.owl.carousel', syncPosition);

    sync2
        .on('initialized.owl.carousel', function () {
            sync2.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
            items: slidesPerPage,
            dots: false,
            nav: false,
            slideTransition: 'linear',
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            slideBy: slidesPerPage,
            responsiveRefreshRate: 10,
        }).on('changed.owl.carousel', syncPosition2);

    function syncPosition(el) {

        var count = el.item.count - 1;
        var current = Math.round(el.item.index - (el.item.count / 2) - .5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }



        sync2
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = sync2.find('.owl-item.active').length - 1;
        var start = sync2.find('.owl-item.active').first().index();
        var end = sync2.find('.owl-item.active').last().index();

        if (current > end) {
            sync2.data('owl.carousel').to(current, 1000, true);
        }
        if (current < start) {
            sync2.data('owl.carousel').to(current - onscreen, 1000, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            sync1.data('owl.carousel').to(number, 1000, true);
        }
    }

    sync2.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        sync1.data('owl.carousel').to(number, 3000, true);
    });

    $('.owl-next').click(function () {

        $('.owl-carousel').trigger('stop.owl.autoplay');

    });

});

$(document).ready(function () {
    var sync3 = $("#sync3");
    var sync4 = $("#sync4");
    var slidesPerPage = 1;
    var syncedSecondary = true;

    sync3.owlCarousel({
        items: 1,
        slideTransition: 'linear',
        nav: true,
        autoplay: true,
        dots: true,
        loop: true,
        responsiveRefreshRate: 200,
        navText: ['', ''],
    }).on('changed.owl.carousel', syncPosition);

    sync4
        .on('initialized.owl.carousel', function () {
            sync4.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
            items: slidesPerPage,
            dots: false,
            nav: false,
            slideTransition: 'linear',
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            slideBy: slidesPerPage,
            responsiveRefreshRate: 10,
        }).on('changed.owl.carousel', syncPosition2);


    function syncPosition(el) {

        var count = el.item.count - 1;
        var current = Math.round(el.item.index - (el.item.count / 2) - .5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }



        sync4
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = sync4.find('.owl-item.active').length - 1;
        var start = sync4.find('.owl-item.active').first().index();
        var end = sync4.find('.owl-item.active').last().index();

        if (current > end) {
            sync4.data('owl.carousel').to(current, 1000, true);
        }
        if (current < start) {
            sync4.data('owl.carousel').to(current - onscreen, 1000, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            sync3.data('owl.carousel').to(number, 1000, true);
        }
    }

    sync4.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        sync3.data('owl.carousel').to(number, 3000, true);
    });

    $('.owl-next').click(function () {

        $('.owl-carousel').trigger('stop.owl.autoplay');

    });

});

$(document).ready(function () {
    var sync5 = $("#sync5");
    var sync6 = $("#sync6");
    var slidesPerPage = 1;
    var syncedSecondary = true;

    sync5.owlCarousel({
        items: 1,
        slideTransition: 'linear',
        nav: true,
        autoplay: true,
        dots: true,
        loop: true,
        responsiveRefreshRate: 200,
        navText: ['', ''],
        responsive: {
            0: {
                items: 1,
                loop: false,
                nav: false,

            },
            768: {
                items: 1
            },
            992: {
                items: 1
            },
            1199: {
                items: 1
            }
        }
    }).on('changed.owl.carousel', syncPosition);

    sync6
        .on('initialized.owl.carousel', function () {
            sync6.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
            items: slidesPerPage,
            dots: false,
            nav: false,
            slideTransition: 'linear',
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            loop: true,
            slideBy: slidesPerPage,
            responsiveRefreshRate: 10,
        }).on('changed.owl.carousel', syncPosition2);


    function syncPosition(el) {

        var count = el.item.count - 1;
        var current = Math.round(el.item.index - (el.item.count / 2) - .5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }



        sync6
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = sync6.find('.owl-item.active').length - 1;
        var start = sync6.find('.owl-item.active').first().index();
        var end = sync6.find('.owl-item.active').last().index();

        if (current > end) {
            sync6.data('owl.carousel').to(current, 1000, true);
        }
        if (current < start) {
            sync6.data('owl.carousel').to(current - onscreen, 1000, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            sync5.data('owl.carousel').to(number, 1000, true);
        }
    }

    sync6.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        sync5.data('owl.carousel').to(number, 3000, true);
    });

    $('.owl-next').click(function () {

        $('.owl-carousel').trigger('stop.owl.autoplay');

    });

});

$(function () {
    $('#ChangeToggle').click(function () {
        $('#navbar-hamburger').toggleClass('hidden');
        $('#navbar-close').toggleClass('hidden');
    });
});

window.addEventListener('load', e => {
    registerSW();
});

async function registerSW() {
    if ('serviceWorker' in navigator) {
        try {
            await navigator.serviceWorker.register('/service-worker.js');
        } catch (e) {
            console.log('ServiceWorker registration failed. Sorry about that.');
        }
    } else {
        console.log('ServiceWorker not support');
    }
}

var selectIds = $('#collapse1,#collapse2,#collapse3,#collapse4,#collapse5,#collapse6,#collapse7,#collapse8,#collapse9,#collapse10,#collapse11,#collapse12,#collapse13,#collapse14,#collapse15,#collapse16,#collapse17,#collapse18');
$(function ($) {
    selectIds.on('show.bs.collapse hidden.bs.collapse', function () {
        $(this).prev().find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
    })
});


jQuery(document).ready(function () {
    fadeMenuWrap();
    jQuery(window).scroll(fadeMenuWrap);
});



function fadeMenuWrap() {
    var scrollPos = window.pageYOffset || document.documentElement.scrollTop;
    if (scrollPos < 300 && window.innerWidth < 420) {
        jQuery('.product_details_right .mobile_btn').fadeIn(300);
    } else {
        jQuery('.product_details_right .mobile_btn').fadeOut(300);
    }
}

$('.accordion').on('click', 'h4', function () {
    $('.accordion h4').removeClass('active');
    $(this).addClass('active');
});

$('.mobile_item').on('click', 'a', function () {
    $('.mobile_item a').removeClass('active');
    $(this).addClass('active');
});



$(document).ready(function () {
    if (localStorage.getItem('hide') !== 'yes') {
        setTimeout(function () {
            $("#myModal_on_load").modal('show');
        }, 1000);
    }
    $(document).on("click", ".hide-modal", function () {
        localStorage.setItem('hide', 'yes');
    });
});

function dataLayerAddToCart(_ele, __qty) {
    let product = $(_ele).data('product');

    dataLayer.push({ ecommerce: null });
    dataLayer.push({
        'event': 'addToCart',
        'ecommerce': {
            'currencyCode': 'INR',
            'add': {
                'products': [{
                    'name': product.name,
                    'id': product.id,
                    'price': product.price,
                    'quantity': __qty
                }]
            }
        }
    });
}

function dataLayerRemoveFromCart(__ele) {
    let product = $(__ele).data('product');
    console.log(product)
    dataLayer.push({ ecommerce: null });
    dataLayer.push({
        'event': 'removeFromCart',
        'ecommerce': {
            'remove': {
                'products': [{
                    'name': product.product.name,
                    'id': product.product.id,
                    'price': product.product.price,
                    'quantity': product.qty
                }]
            }
        }
    });
}

function dataLayerSale(order) {
    dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
    dataLayer.push({
        'ecommerce': {
            'purchase': {
                'actionField': {
                    'id': order.id,                         // Transaction ID. Required for purchases and refunds.
                    'revenue': order.grand_total,                     // Total transaction value (incl. tax and shipping)
                    'tax': 0
                },
                'products': order.products.map((pro) => {
                    return {
                        name: pro.name,
                        id: pro.id,
                        price: pro.price,
                        quantity: pro._joinData.quantity
                    }
                })
            }
        }
    });
}

function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    var emailAddress = profile.getEmail()

    if (emailAddress) {
        $.ajax({
            url: HOST + "customer/social-login?email=" + emailAddress,
            type: 'GET',
            cache: false,
            contentType: 'json',
            processData: false,
            success: function (response) {
                console.log(response)
            }
        });
    }
}