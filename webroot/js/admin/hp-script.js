hpAdmin = {
    uploadFiles: function (uploadedFrom) {
        if (uploadedFrom == 'media-chooser') {
            $('.m_library').trigger('click');
        }
        var allFiles = document.getElementById('file-input').files;
        var totalFiles = allFiles.length;
        for (var i = 0; i < totalFiles; i++) {
            this.uploadFilesToServer(allFiles[i]);
        }
        document.getElementById('file-input').value = '';
    },

    uploadFilesToServer: function (file) {
        var formData = new FormData(document.getElementById('uploadFileForm'));
        formData.append('media', file);
        var patternString = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        var randomId = '';
        for (var i = 0; i < 10; i++) {
            randomId += patternString.charAt((Math.random() * 60));
        }
        $.ajax({
            url: HPADMIN + 'media/add',
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            xhr: function () {
                var jqXHR = null;
                if (window.ActiveXObject) {
                    jqXHR = new window.ActiveXObject("Microsoft.XMLHTTP");
                } else {
                    jqXHR = new window.XMLHttpRequest();
                }
                // Upload progress
                jqXHR.upload.addEventListener('progress', function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded * 100) / evt.total);
                        $("#" + randomId).children('.prograss_bar').children('span').css('width', percentComplete + '%');
                    }
                }, false);
                return jqXHR;
            },
            beforeSend: function (xhr) {
                var dataHtml = '<div class="media_check" id="' + randomId + '">'
                dataHtml += '<div class="prograss_bar"><span></span></div></div>'
                $('#allMedialist').prepend(dataHtml);
            },
            success: function (data, textStatus, jqXHR) {
                var data = JSON.parse(data);
                if (data.status) {
                    $('#' + randomId).replaceWith(data.message);
                } else {
                    $('#' + randomId).remove();
                    var dataHtml = '<p><span>Error!</span> ' + data.message + '</p>';
                    $("#errorDisplay").append(dataHtml).css('display', 'block');
                }
            }
        });
    },

    isMediaSelected: function () {
        var status = 0;
        $.each($('input[name="mediaId[]"]:checked'), function () {
            status = 1;
        });
        if (status)
            return true;
        else
            return false;
    },

    updateMediaDetails: function () {
        var mediaForm = document.getElementById('updateMediaForm');
        $.ajax({
            url: HPADMIN + "media/edit",
            type: 'POST',
            data: new FormData(mediaForm),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-CSRF-Token', Cookies.get('csrfToken'));
                $("#mediaUpdateStatus").text('Saving changes please wait.....');
            },
            success: function (data, textStatus, jqXHR) {
                var data = JSON.parse(data);
                if (data.status) {
                    var mediaId = $("#updateMediaForm").find('input[name=id]').val();
                    $.each($('.media_check'), function () {
                        if ($(this).attr('data-id') == mediaId) {
                            $(this).attr('data-title', $("#originalMediaTitle").val())
                            $(this).attr('data-alt', $("#originalMediaAlt").val())
                            $(this).attr('data-caption', $("#originalMediaCaption").val())
                        }
                    });
                }
                $("#mediaUpdateStatus").text(data.message);
            }
        });
    },

    sendToPageNumber: function (val) {
        var currentLocation = window.location.href;
        var url = currentLocation.split('?');
        url = url[0] + '?page=' + val;
        window.location.href = url;
    },

    saveNewCategory: function (ref, event) {
        event.preventDefault();
        $.ajax({
            url: HPADMIN + 'categories/add',
            type: 'POST',
            data: new FormData(ref),
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function (xhr) {
                $(ref).find('button[type=submit]').text('Saving...');
            }, success: function (data, textStatus, jqXHR) {
                var data = JSON.parse(data);
                if (data.status) {
                    window.location.reload();
                } else {
                    $("#errorDisplay").append('<p><span>Error!</span> ' + data.message + '</p>').css('display', 'block');
                }
            }
        });
    },

    saveNewTag: function (ref, event) {
        event.preventDefault();
        $.ajax({
            url: HPADMIN + 'tags/add',
            type: 'POST',
            data: new FormData(ref),
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function (xhr) {
                $(ref).find('button[type=submit]').text('Saving...');
            }, success: function (data, textStatus, jqXHR) {
                var data = JSON.parse(data);
                if (data.status) {
                    window.location.reload();
                } else {
                    $("#errorDisplay").append('<p><span>Error!</span> ' + data.message + '</p>').css('display', 'block');
                }
            }
        });
    },

    mediaChooser: function (inputFieldName, replaceWith) {
        var loadMoreRef = this;
        $.ajax({
            url: HPADMIN + "media/mediachooser/" + inputFieldName + '/' + replaceWith,
            type: 'GET',
            beforeSend: function (xhr) {

            }, success: function (data) {
                $('body').append(data);
            }
        });
    },

    loadMoreMedia: function (mediaId) {
        var type = $("#media-type-filter").val();
        var date = $("#media-date-filter").val();
        var search = $("#media-search-filter").val();
        if (typeof (type) == 'undefined' || type == '')
            type = 'none';
        else
            type = type.replace('/', '-');
        if (typeof (date) == 'undefined' || date == '')
            date = 'none';
        if (typeof (search) == 'undefined' || search == '')
            search = 'none';
        var url = HPADMIN + "media/loadmore/" + mediaId + '/' + type + '/' + date + '/' + search;
        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function (xhr) {
                $("#dataLoadingImge").css('display', 'block');
            }, success: function (data) {
                $("#allMedialist").append(data);
                $("#dataLoadingImge").css('display', 'none');
            }
        });
    },

    useMedia: function (inputFieldName, replaceWith) {
        var medias = [];
        var urls = [];
        var mediaType = [];
        $("#allMedialist").find('input[name="mediaId[]"]').each(function () {
            if ($(this).is(':checked')) {
                medias.push($(this).val());
                urls.push($(this).parent('label').prev().attr('src'));
                mediaType.push($(this).parent('label').parent('.media_check').attr('data-filetype'));
            }
        });
        if (medias.length != 0) {
            $('input[name="' + inputFieldName + '"]').val(medias);
            var dataHtml = '<div id="' + replaceWith + '">';
            for (var i = 0; i < urls.length; i++) {
                if (mediaType[i].indexOf('video') != -1) {
                    dataHtml += '<div><video>';
                    dataHtml += '<source src="' + urls[i] + '" />';
                    dataHtml += '</video><span onclick=hpAdmin.removeMedia("' + medias[i] + '","' + inputFieldName + '",this)>&times;</span></div>';
                } else {
                    dataHtml += '<div><img src="' + urls[i] + '" /><span onclick=hpAdmin.removeMedia("' + medias[i] + '","' + inputFieldName + '",this)><i class="fa fa-minus-circle" aria-hidden="true"></i></span></div>';
                }
            }
            dataHtml += '</div>';
            $("#" + replaceWith).replaceWith(dataHtml);
        }
        $(".media_gallery_section").remove();
    },

    removeMedia: function (mediaId, inputFieldName, selectorRef) {
        var medias = $('input[name="' + inputFieldName + '"]').val().split(',');
        var indexNo = medias.indexOf(mediaId);
        medias.splice(indexNo, 1);
        if (medias.length == 0) {
            $('input[name="' + inputFieldName + '"]').val('-1');
        } else {
            $('input[name="' + inputFieldName + '"]').val(medias);
        }
        $(selectorRef).parent('div').remove();
    },

    searchUser: function (ref) {
        $(document).find('form').attr('action', window.location.href);
        $(document).find('form').attr('method', 'get');
    },

    generateAndValidateProductSlug: function (name) {
        $.ajax({
            url: HPADMIN + "products/slug/" + name,
            type: 'GET',
            beforeSend: function (xhr) {

            }, success: function (data, textStatus, jqXHR) {
                var paramlink = $("#paramlink-sample").find('a').attr('data-paramlink') + '<span id="product-slug">' + data + '</span>';
                $("#paramlink-sample").find('a').html(paramlink);
                $("#paramlink-sample").css('display', 'block');
                $("#edit-product-slug").css('display', 'inline-block');
                $('input[name=slug]').val(data);
            }
        });
    },

    addTagsToPost: function (ref) {
        var tags = $("#product-temp-tags-input").val().split(',');
        $("#product-temp-tags-input").val('');
        tags = tags.filter(function (item, pos) {
            return tags.indexOf(item) == pos;
        });
        var totlTags = tags.length;
        for (var i = 0; i < totlTags; i++) {
            $.ajax({
                url: HPADMIN + "tags/saveTagsFromProductPage/" + tags[i],
                type: 'GET',
                beforeSend: function (xhr) {
                    $(ref).html('<img height="12px" src="' + HPADMIN.replace('hpadmin', 'img') + '/loading.gif" />');
                },
                success: function (response) {
                    $(ref).html('Add');
                    response = JSON.parse(response);
                    if (response.status) {
                        $("#added-product-tag-list").append('<li><i class="fa fa-minus-circle" onclick="hpAdmin.removeTagsFromProducts(this,' + response.data.id + ')"></i> ' + response.data.name + '</li>');
                        var currentProductTags = $("#product-tags").val();
                        if (currentProductTags == '') {
                            $("#product-tags").val(response.data.id);
                        } else {
                            $("#product-tags").val(currentProductTags + ',' + response.data.id);
                        }
                    }
                }
            });
        }
    },

    removeTagsFromProducts: function (ref, tagId, texonomy_to_product) {
        if (typeof (texonomy_to_product) == 'undefined') {
            var addedTags = $("#product-tags").val().split(',');
            var indexNo = addedTags.indexOf('' + tagId);
            addedTags.splice(indexNo, 1);
            $("#product-tags").val(addedTags);
            $(ref).parent('li').remove();
        }
    },

    searchTags: function (ref, term) {
        if (term != '') {
            $.ajax({
                url: HPADMIN + "tags/searchTags/" + term,
                type: 'GET',
                beforeSend: function (xhr) {
                    $(ref).next('button').html('<img height="12px" src="' + HPADMIN.replace('hpadmin', 'img') + '/loading.gif" />');
                }, success: function (data, textStatus, jqXHR) {
                    $(ref).next('button').html('Add');
                    $("#product-temp-tags-input").siblings('ul').replaceWith(data);
                }
            });
        }
    },

    addTagFromSearch: function (ref, tagId) {
        var currentProductTags = $("#product-tags").val();
        if (currentProductTags.indexOf('' + tagId) == -1) {
            $("#added-product-tag-list").append('<li><i class="fa fa-minus-circle" onclick="hpAdmin.removeTagsFromProducts(this,' + tagId + ')"></i> ' + $(ref).text() + '</li>');
            if (currentProductTags == '') {
                $("#product-tags").val(tagId);
            } else {
                $("#product-tags").val(currentProductTags + ',' + tagId);
            }
        }
        $("#product-temp-tags-input").val('');
        $("#product-temp-tags-input").siblings('ul').css('display', 'none');
    },

    setItemIds: function (ref) {
        var itemIds = ''
        $.each($('input[name="itemId[]"]'), function () {
            if ($(this).is(':checked')) {
                if (itemIds != '')
                    itemIds += ',' + $(this).val();
                else
                    itemIds += $(this).val();
            }
        });
        if (itemIds != '') {
            $(ref).find('input[name="actionIds"]').val(itemIds);
            return true;
        } else {
            return false;
        }
    },

    searchSuggestion: function (term, suggesionInclude, replaceWith) {
        $.ajax({
            type: 'get',
            url: HPADMIN + "products/get_search_term/" + term + '/' + suggesionInclude,
            success: function (data) {
                $("#" + replaceWith).find('ul').replaceWith(data);
                $("#" + replaceWith).find('ul').css('display', 'block');
            }
        });
    },

    lodmoremedia: function () {
        if ($("#allMedialist").scrollTop() + $("#allMedialist").innerHeight() >= Number($("#allMedialist")[0].scrollHeight) - 1) {
            var mediaId = $("#allMedialist div:last-child").attr('data-id');
            hpAdmin.loadMoreMedia(mediaId);
        }
    },

    comment: function (ref) {
        var customerId = $("#customerId").val();
        var customerRating = $("#customerRating").val();
        var customerReview = $("#customerReview").val();
        var productId = $("#productId").val();

        if ($.isNumeric(productId) && $.isNumeric(customerId) && $.isNumeric(customerRating) && customerReview != '') {
            $.ajax({
                url: HPADMIN + "reviews/add",
                type: 'POST',
                data: {"user_id": customerId, "rating": customerRating, "comment": customerReview, "product_id": productId, "status": 'pending'},
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                    $(ref).text('Saving..');
                }, success: function (data) {
                    if (data == 'success') {
                        $("#customerId").val('');
                        $("#customerRating").val('');
                        $("#customerReview").val('');
                        $("#reviewBy").val('');
                        $(ref).text('Comment');
                        $(".rated").removeClass('rated');
                    }
                }
            });
        }
    },

    getUsers: function (terms, ref) {
        $.ajax({
            url: HPADMIN + "users/searchForUsers/" + terms,
            type: 'GET',
            beforeSend: function (xhr) {
                $(ref).addClass('loadingInput');
                $("#customerId").val('');
            }, success: function (users) {
                users = JSON.parse(users);
                if (users.length > 0) {
                    let htmlData = '<ul class="user-suggesion">';
                    users.forEach(function (user) {
                        htmlData += '<li data-id="' + user.id + '" data-email="' + user.email + '">' + user.name + '</li>';
                    });
                    htmlData += '</ul>';
                    if ($(ref).next('ul').length === 1)
                        $(ref).next('ul').replaceWith(htmlData);
                    else
                        $(ref).after(htmlData);
                    $(".user-suggesion").css('display', 'block');
                } else {
                    $(".user-suggesion").remove();
                }
                $(ref).removeClass('loadingInput');
            }
        });
    },

    importPostcodes: (ref, event) => {
        event.preventDefault();

        var file_name = $("input[name=postcodeFile]").val();
        var file_name = file_name.split('.')[1].toLowerCase();

        if (file_name != 'csv' && file_name != 'xlsx') {
            $("#errorDisplay").append('<p><span>Error!</span> Invalid file formate.</p>');
            $("#errorDisplay").css('display', 'block');
            return false;
        }

        $.ajax({
            url: HPADMIN + "shipping_zones/import",
            type: 'POST',
            data: new FormData(ref),
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function (xhr) {
                $("#file-input").prev('label').children('i').text('Processing..');
                $("#file-input").prev('label').append('<span class="y9uHb"></span>');
            }, success: function (response) {
                $("#file-input").prev('label').children('span').remove();

                if (response.status === 'error') {
                    $("#import-form")[0].reset();
                    $("#errorDisplay").append(`<p><span>Error!</span> ${response.message}</p>`);
                    $("#errorDisplay").css('display', 'block');
                    $("#file-input").prev('label').children('i').text('Choose File');
                } else {
                    $("#import-form").remove();
                    var template = `<h2>TOTAL IMPORTED: ${response.total}</h2>`;
                    $(".media_upload").append(template);
                }
            }
        });
    },
};
$(document).ready(function () {
    $(document).on('click', '#edit-product-slug', function () {
        $(this).css('display', 'none');
        $("#product-slug").replaceWith('<span id="product-slug"><input class="edit-product-slug" type="text" id="product-slug-input" value="' + $("#product-slug").text() + '" /></span><button type="button" id="save-product-slug">OK</button>');
    });
    $(document).on('click', '#save-product-slug', function () {
        hpAdmin.generateAndValidateProductSlug($("#product-slug-input").val());
        $("#edit-product-slug").css('display', 'inline-block');
    });
    $("#displaySingleError").click(function () {
        $("#errorDisplay").children('p').remove();
        $("#errorDisplay").css('display', 'none');
    });
    $(".removeMediaErrorsFlash").click(function () {
        $(this).parent('div').remove();
    });
    $(document).on('click', '.select-media-win .media_check', function () {
        $(this).find('input[name="mediaId[]"]').trigger('click');
        if ($(this).find('input[name="mediaId[]"]').is(':checked')) {
            $(this).addClass('m-active');
        } else {
            $(this).removeClass('m-active');
        }
    });
    $(document).on('click', '.suggesions>form>ul>li', function () {
        $("input[name=search]").val($(this).children('b').text());
        $(".suggesions").find('ul').css('display', 'none');
    });
    $(document).on('change', '#media-type-filter', function () {
        $("#allMedialist").empty();
        hpAdmin.loadMoreMedia('none');
    });
    $(document).on('change', '#media-date-filter', function () {
        $("#allMedialist").empty();
        hpAdmin.loadMoreMedia('none');
    });
    $(document).on('keyup', '#media-search-filter', function () {
        $("#allMedialist").empty();
        hpAdmin.loadMoreMedia('none');
    });
    // Include products to coupon
    $(document).on('click', '#product-include-search-coupon>ul>li', function () {
        var ele = $("#product-include-coupon-added").find('[value=' + $(this).attr('data-id') + ']').attr('value');
        if (typeof (ele) == 'undefined') {
            var dataHtml = '<span class="coupon-products">';
            dataHtml += '<i class="fa fa-minus-circle" aria-hidden="true"></i> ';
            dataHtml += $(this).children('b').text();
            dataHtml += '<input name="products[]" type="number" value="' + $(this).attr('data-id') + '" />';
            dataHtml += '</span>';
            $("#product-include-coupon-added").append(dataHtml);
            $("#product-include-coupon-added").css('display', 'block');
            $("#product-include-search-coupon").find('ul').css('display', 'none');
            $("#product-include-search-coupon").find('input[type="text"]').val('');
            $("#product-include-search-coupon").find('input[type="text"]').focus();
        }
    });
    $(document).on('click', '#product-include-coupon-added>.coupon-products>.fa-minus-circle', function () {
        $(this).parent('.coupon-products').remove();
        if ($('#product-include-coupon-added').children().length == 0) {
            $("#product-include-coupon-added").css('display', 'none');
        }
    });
    // Exclude products from coupon
    $(document).on('click', '#product-exclude-search-coupon>ul>li', function () {
        var ele = $("#product-exclude-coupon-added").find('[value=' + $(this).attr('data-id') + ']').attr('value');
        if (typeof (ele) == 'undefined') {
            var dataHtml = '<span class="coupon-products">';
            dataHtml += '<i class="fa fa-minus-circle" aria-hidden="true"></i> ';
            dataHtml += $(this).children('b').text();
            dataHtml += '<input name="exclude_products[]" type="number" value="' + $(this).attr('data-id') + '" />';
            dataHtml += '</span>';
            $("#product-exclude-coupon-added").append(dataHtml);
            $("#product-exclude-coupon-added").css('display', 'block');
            $("#product-exclude-search-coupon").find('ul').css('display', 'none');
            $("#product-exclude-search-coupon").find('input[type="text"]').val('');
            $("#product-exclude-search-coupon").find('input[type="text"]').focus();
        }
    });
    $(document).on('click', '#product-exclude-coupon-added>.coupon-products>.fa-minus-circle', function () {
        $(this).parent('.coupon-products').remove();
        if ($('#product-exclude-coupon-added').children().length == 0) {
            $("#product-exclude-coupon-added").css('display', 'none');
        }
    });
    // Include categories to coupon
    $(document).on('click', '#categories-include-search-coupon>ul>li', function () {
        var ele = $("#categories-include-coupon-added").find('[value=' + $(this).attr('data-id') + ']').attr('value');
        if (typeof (ele) == 'undefined') {
            var dataHtml = '<span class="coupon-products">';
            dataHtml += '<i class="fa fa-minus-circle" aria-hidden="true"></i> ';
            dataHtml += $(this).children('b').text();
            dataHtml += '<input name="categories[]" type="number" value="' + $(this).attr('data-id') + '" />';
            dataHtml += '</span>';
            $("#categories-include-coupon-added").append(dataHtml);
            $("#categories-include-coupon-added").css('display', 'block');
            $("#categories-include-search-coupon").find('ul').css('display', 'none');
            $("#categories-include-search-coupon").find('input[type="text"]').val('');
            $("#categories-include-search-coupon").find('input[type="text"]').focus();
        }
    });
    $(document).on('click', '#categories-include-coupon-added>.coupon-products>.fa-minus-circle', function () {
        $(this).parent('.coupon-products').remove();
        if ($('#categories-include-coupon-added').children().length == 0) {
            $("#categories-include-coupon-added").css('display', 'none');
        }
    });
    // Exclude categories from products
    $(document).on('click', '#categories-exclude-search-coupon>ul>li', function () {
        var ele = $("#categories-exclude-coupon-added").find('[value=' + $(this).attr('data-id') + ']').attr('value');
        if (typeof (ele) == 'undefined') {
            var dataHtml = '<span class="coupon-products">';
            dataHtml += '<i class="fa fa-minus-circle" aria-hidden="true"></i> ';
            dataHtml += $(this).children('b').text();
            dataHtml += '<input name="exclude_categories[]" type="number" value="' + $(this).attr('data-id') + '" />';
            dataHtml += '</span>';
            $("#categories-exclude-coupon-added").append(dataHtml);
            $("#categories-exclude-coupon-added").css('display', 'block');
            $("#categories-exclude-search-coupon").find('ul').css('display', 'none');
            $("#categories-exclude-search-coupon").find('input[type="text"]').val('');
            $("#categories-exclude-search-coupon").find('input[type="text"]').focus();
        }
    });
    $(document).on('click', '#categories-exclude-coupon-added>.coupon-products>.fa-minus-circle', function () {
        $(this).parent('.coupon-products').remove();
        if ($('#categories-exclude-coupon-added').children().length == 0) {
            $("#categories-exclude-coupon-added").css('display', 'none');
        }
    });
    $(document).on('click', '.user-suggesion li', function () {
        $("#customerId").val($(this).attr('data-id'));
        $("#reviewBy").val($(this).text() + '<' + $(this).attr('data-email') + '>');
        $(this).parent('ul').remove();
    });
});

// Adding active class to menu
$(document).ready(function () {
    var sel = $(".left_menu a:contains(" + CONTROLLER + ")");
    sel.each(function () {
        var parent = $(this).parent('li').parent('ul').parent('li');
        if (parent.length > 0) {
            parent.children('a').addClass('active');
        } else {
            $(this).addClass('active');
        }
    });
    var sel = $(".left_menu2 a:contains(" + CONTROLLER + ")");
    sel.each(function () {
        var parent = $(this).parent('li').parent('ul').parent('span').parent('li');
        if (parent.length > 0) {
            parent.children('a').addClass('active');
        } else {
            $(this).addClass('active');
        }
    });
});
// End

function getDashboardData(start_date, end_date, get_data_for) {

    if (get_data_for === "orders") {
        var uri = encodeURI(HPADMIN + "dashboard/orders/" + start_date + "/" + end_date);
    }
    if (get_data_for === "top_selling") {
        var uri = encodeURI(HPADMIN + "dashboard/getTopSelingProducts/" + start_date + "/" + end_date);
    }

    if (get_data_for === 'sales') {
        var uri = encodeURI(HPADMIN + "dashboard/sales/" + start_date + "/" + end_date);
    }

    $.ajax({
        url: uri,
        type: 'GET',
        beforeSend: function (xhr) {

        }, success: function (response) {
            if (get_data_for === 'orders') {
                renderOrderGraph(response);
            }
            if (get_data_for === 'top_selling') {
                displayTopSellingProducts(response);
            }
            if (get_data_for === 'sales') {
                renderSalesGraph(response);
                console.log(Math.min(response.sale_amount));
            }
        }
    })
}

function renderOrderGraph(response) {
    var config = {
        type: 'pie',
        data: {
            datasets: [{
                    data: [
                        response.allOrders,
                        response.ordersInProcessing,
                        response.ordersShipped,
                        response.ordersCompleted,
                        response.ordersCancelled,
                        response.orderRefunded,
                        response.ordersOnHold,
                        response.ordersFaild,
                    ],
                    backgroundColor: [
                        '#0080ff',
                        '#40ff00',
                        '#ffff00',
                        '#00cc00',
                        '#ff3300',
                        '#b3b300',
                        '#661aff',
                        '#b30000',
                    ],
                    label: 'Orders'
                }],
            labels: [
                'All Orders',
                'In Processing',
                'Orders Shipped',
                'Orders Completed',
                'Orders Canceled',
                'Orders Refunded',
                'Orders On Hold',
                'Orders Failed',
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'right',
                labels: {
                    usePointStyle: true,
                    padding: 15,
                    fontSize: 15,
                },
            },
        }
    };

    $("#orders-pie-chart").replaceWith('<canvas id="orders-pie-chart"></canvas>');
    var ctx = document.getElementById('orders-pie-chart').getContext('2d');

    window.myPie = new Chart(ctx, config);
}

function displayTopSellingProducts(response) {
    $("#top_selling_products_list").html('');
    response.forEach(function (product) {
        var name = `<td>${product.name}</td>`;
        var regular_price = `<td>${Number(product.total_price).toFixed(2)}</td>`;
        var selling_price = `<td>${Number(product.total_sale_price).toFixed(2)}</td>`;
        var quantity = `<td>${Number(product.total_selling_quantity).toFixed(2)}</td>`;

        $("#top_selling_products_list").append(`<tr>${name + regular_price + selling_price + quantity}</tr>`);
    });
}

function renderSalesGraph(response) {
    $("#sales").replaceWith("<canvas id='sales'></canvas>");
    
    $(".data:nth-child(1)").children('h1').text(response.sale_amount.reduce((a, b) => Number(a) + Number(b), 0).toFixed(2));
    $(".data:nth-child(3)").children('h1').text(response.shipping_charges.reduce((a, b) => Number(a) + Number(b), 0).toFixed(2));
    $(".data:nth-child(4)").children('h1').text(response.coupon_discounts.reduce((a, b) => Number(a) + Number(b), 0).toFixed(2));
    $(".data:nth-child(5)").children('h1').text(response.other_discounts.reduce((a, b) => Number(a) + Number(b), 0).toFixed(2));
    $(".data:nth-child(2)").children('h1').text(response.orders_placed.reduce((a, b) => Number(a) + Number(b), 0));
    
    var config = {
        type: 'line',
        data: {
            labels: response.labels,
            datasets: [{
                    label: 'Total Revenue',
                    backgroundColor: '#000080',
                    borderColor: '#000080',
                    data: response.sale_amount,
                    fill: false,
                }, {
                    label: 'Orders Placed',
                    fill: false,
                    backgroundColor: '#00b300',
                    borderColor: '#00b300',
                    data: response.orders_placed,
                },
                {
                    label: 'Shipping Charges',
                    fill: false,
                    backgroundColor: '#e600e6',
                    borderColor: '#e600e6',
                    data: response.shipping_charges,
                },
                {
                    label: 'Coupon Discounts',
                    fill: false,
                    backgroundColor: '#ff3300',
                    borderColor: '#ff3300',
                    data: response.coupon_discounts,
                },
                {
                    label: 'Other Discounts',
                    fill: false,
                    backgroundColor: '#6600cc',
                    borderColor: '#6600cc',
                    data: response.other_discounts,
                }
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
        }
    };

    var ctx = document.getElementById('sales').getContext('2d');
    window.myLine = new Chart(ctx, config);
}