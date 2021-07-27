// var swiper = new Swiper('.swiper-main-container', {
//     pagination: '.swiper-pagination',
//     paginationClickable: true,
//     calculateHeight: true,
//     autoplay: 3000,
//     speed: 700,
//     effect: 'fade'
// });
// var swiper_topic = new Swiper('.swiper-topic', {
//     effect: 'coverflow',
//     grabCursor: true,
//     centeredSlides: false,
//     loop: true,
//     slidesPerView: 'auto',
//     coverflowEffect: {rotate: 50, stretch: 0, depth: 100, modifier: 1, slideShadows: true,},
//     pagination: {el: '.swiper-pagination',},
// });
// var swiper_quote = new Swiper('.swiper-quote-container', {
//     pagination: '.swiper-pagination',
//     paginationClickable: true,
//     nextButton: '.swiper-button-next',
//     prevButton: '.swiper-button-prev',
//     parallax: true,
//     speed: 600,
// });
// var swiper_product = new Swiper('.swiper-product-container', {
//     pagination: '.swiper-pagination',
//     slidesPerView: 4,
//     slidesPerGroup: 4,
//     paginationClickable: true,
//     watchOverflow: true,
//     spaceBetween: 5,
//     breakpoints: {
//         480: {
//             slidesPerView: 2
//         }
//     },
//     onInit: function (swiper) {
//         if (swiper.slides.length === 1) {
//             $('.swiper-pagination').hide();
//         }
//     }
// });
// var swiper_partner = new Swiper('.swiper-partner-container', {
//     pagination: '.swiper-pagination',
//     slidesPerView: 8,
//     slidesPerGroup: 8,
//     paginationClickable: true,
//     centeredSlides: true,
//     watchOverflow: true,
//     spaceBetween: 5,
//     breakpoints: {
//         480: {
//             slidesPerView: 5
//         }
//     }
// });
var swiper_home_top = new Swiper('.swiper-container-home-top', {
    slidesPerView: 5,
    spaceBetween: 30,
    slidesPerGroup: 1,

    loop: true,
    loopFillGroupWithBlank: true,
    // autoplay: true,
    pagination: {
        // el: '.swiper-pagination-product-discount',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});
var swiper_home_top_moble = new Swiper('.swiper-container-home-top-moble', {
    slidesPerView: 2,
    spaceBetween: 30,
    slidesPerGroup: 1,

    loop: true,
    loopFillGroupWithBlank: true,
    autoplay: true,
    pagination: {
        // el: '.swiper-pagination-product-discount',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});

var swiper_patner = new Swiper('.swiper-partner-container', {
    slidesPerView: 5,
    spaceBetween: 30,
    slidesPerGroup: 1,

    loop: true,
    loopFillGroupWithBlank: true,
    autoplay: true,
    pagination: {
        // el: '.swiper-pagination-product-discount',
        clickable: true,
    },
});

var swiper_patner_mobile = new Swiper('.swiper-partner-container-mobile', {
    slidesPerView: 2,
    spaceBetween: 30,
    slidesPerGroup: 1,

    loop: true,
    loopFillGroupWithBlank: true,
    autoplay: true,
    pagination: {
        // el: '.swiper-pagination-product-discount',
        clickable: true,
    },
});

var sw;
if (document.getElementsByClassName('swiper-main-container').length > 0 && Swiper) {
    sw = new Swiper('.swiper-main-container', {
        loop: true,
        autoplay: true,
        pagination: {
            el: '.swiper-pagination',
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        scrollbar: {
            el: '.swiper-scrollbar',
        },
        // slidesPerView: 4
    });
}

/* plugin  */
$(function () {

    $(".div_cate_vote").rateYo({
        rating: $(".div_cate_vote").data('rate-init'),
        fullStar: true,
        starWidth: "15px"
    }).on("rateyo.set", function (e, data) {
        rate_vote = data.rating;
        object_id = $(".div_cate_vote").data('object_id');
        _data = 'object_id=' + object_id + '&vote_rate=' + rate_vote;
        $.ajax({
            url: $(".div_cate_vote").data('url-post'),
            data: _data,
            type: 'POST',
            datatype: '',
            catch: false,
            success: function (data) {
                result = JSON.parse(data);
                $(".div_cate_vote").rateYo("option", "readOnly", true);
            }
        });
    });
});

(function ($) {

    $(".swiper-container").hover(function () {
        var mySwiper = document.querySelector('.swiper-container').swiper;
        mySwiper.autoplay.stop();
    }, function () {
        var mySwiper = document.querySelector('.swiper-container').swiper;
        mySwiper.autoplay.start();
    });

    $.fn.stickyNav = function (opt) {
        var o = this, w = $(window), options = $.extend(opt, {});
        var threshold = options.threshold || 120;
        var clsName = options.clsName || 'in';

        var _runner = function (pos) {
            if (pos > threshold) {
                o.addClass(clsName);
            } else {
                o.removeClass(clsName);
            }
        };

        _runner(w.scrollTop());

        w.scroll(function () {
            _runner(w.scrollTop());
        });

        return o;
    };
    var nav = $('.navbar').stickyNav({
        threshold: 66,
        clsName: 'slide-down'
    });

    $.fn.responsiveImage = function () {
        var o, img, src, _runner = function () {
            o = $(this);
            if ((img = $('img', o)) && (src = img.attr('src')) !== null) {
                o.css('background-image', 'url(\'' + src + '\')').css('background-size', 'cover');
            }
        };
        if (!this.hasClass('img-wrap')) {
            return $('.img-wrap', this).each(_runner);
        }
        return this.each(_runner);
    };

    $('.project-tab[data-toggle="tab"]:visible').on('shown.bs.tab', function (e) {
        var categoryId = $(e.target).data('index');
        $.get('/project/ajaxCategory/' + categoryId, function (res) {
            $('.tab-content').html(res).responsiveImage();
        });
    });

    var firstCat;
    if ((firstCat = $('.category-nav:visible > li.active:first-child > a')) && firstCat.length > 0) {
        $.get('/project/ajaxCategory/' + firstCat.data('index'), function (res) {
            $('.tab-content').html(res).responsiveImage();
        });
    }

    $('.category-top-tab[data-toggle="tab"]:visible').on('shown.bs.tab', function (e) {
        var categoryId = $(e.target).data('index');
        $.get('/category/ajaxCategoryTop/' + categoryId, function (res) {
            $('.tab-content').html(res).responsiveImage();
        });
    });

    var firstCatTop;
    if ((firstCatTop = $('.category-top-nav:visible > li.active:first-child > a')) && firstCatTop.length > 0) {
        $.get('/category/ajaxCategoryTop/' + firstCatTop.data('index'), function (res) {
            $('.tab-content').html(res).responsiveImage();
        });
    }

    var getCartInfo = function () {
        let cart, badge = $('#cart-badge');
        $.get('/cart', (res) => {
            if (!res || !(cart = JSON.parse(res))) return;
            $('span', badge).text(cart.total);
        });
    };
    $(document).ready(getCartInfo);
    var o;
    $('.add-to-cart-btn:visible').each(function () {
        o = $(this);
        o.click(function () {
            $.post(o.attr('href'), o.data(), function (res) {
                if (res) {
                    $.toast({
                        heading: 'Giỏ hàng',
                        text: 'Thêm vào giỏ hàng thành công',
                        icon: 'success',
                        bgColor: 'green',
                        position: 'bottom-right'
                    });
                    getCartInfo();
                }
            });
            return false;
        });
    });

    $('.img-wrap:visible').responsiveImage();

    $('.e-carousel:visible').lightSlider({
        gallery: true,
        item: 1,
        loop: true,
        thumbItem: 4,
        slideMargin: 0,
        enableDrag: true,
        controls: true,
        currentPagerPosition: 'left',
        onSliderLoad: function (el) {
            $(el).removeClass('no-js');
            $('.lSPager.lSGallery > li > a', o).addClass('img-wrap').responsiveImage();
        }
    });

    $('.content-table:visible').each(function () {
        var o = $(this);
        $('a.btn-tb-content:visible', o).on('click', function (e) {
            e.preventDefault();
            o.toggleClass('closed');
        });
    });

    $('.gallery-wrap:visible').each(function () {
        var o = $(this);
        $('.singer-carousel:visible', o).lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            thumbItem: 4,
            slideMargin: 0,
            enableDrag: true,
            controls: true,
            currentPagerPosition: 'left',
            onSliderLoad: function (el) {
                $(el).removeClass('no-js');
                $('.lSPager.lSGallery > li > a', o).addClass('img-wrap').responsiveImage();
            }
        });
    });

    $('.video-modal').on('shown.bs.modal', function (e) {
        var modal = $(this), btn = $(e.relatedTarget), src = btn.data('src');
        $('.modal-content', modal).html('<div class="embed-responsive embed-responsive-4by3">' +
            '<iframe src="' + src + '" frameborder="0" ' +
            'allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" ' +
            'allowfullscreen class="embed-responsive-item"></iframe>' +
            '</div>');
    }).on('hidden.bs.modal', function (e) {
        $('.modal-content', $(this)).html('');
    });

    $('#contactConfirmModal').on('hidden.bs.modal', function () {
        console.log('hide contactConfirmModal and post');
        // do something…
        form = $("#contactFormAjax");
        //$("#contactFormAjax").ajaxSubmit({url: form.attr('action'), type: 'post'});
        $.post(form.attr('action'), $('#contactFormAjax').serialize());

        $('#contactFormAjax').trigger("reset");
        grecaptcha.reset();
    });

    $("#contactFormAjax").submit(function (event) {
        var response = grecaptcha.getResponse();

        if (response.length == 0) {
            return false;
        } else {
            $('#contactModal').modal('hide');
            //alert( "Handler for .submit() called." );
            $('#contactConfirmModal').modal();
        }

        //event.preventDefault();
        return false;
    });


})(jQuery);

$(function () {
    $('#start_date').datetimepicker({
        format: 'DD/MM/yyyy'
    });
    $('#end_date').datetimepicker({
        format: 'DD/MM/yyyy'
    });

});

function process_district() {
    var province_id = $('#province').val();
    $.get('/UserPostManage/select_district/' + province_id, function (data) {
        // alert("Data: " + data + "\nStatus: " + status);
        result = JSON.parse(data);
        _html = '';
        for (i = 0; i < result.length; i++) {
            _html += '<option  value="' + result[i].id + '">' + result[i]._name + '</option>';
        }
        $('#district').html(_html);
        $('.selectpicker').selectpicker("refresh");
    });
}

function process_sold_type() {
    var parent_id = $('#sold_type').val();
    $.get('/UserPostManage/select_product_category/' + parent_id, function (data) {
        result = JSON.parse(data);
        _html = '';
        for (i = 0; i < result.length; i++) {
            _html += '<option  value="' + result[i].id + '">' + result[i].title + '</option>';
        }
        $('#product_category_id').html(_html);
        $('.selectpicker').selectpicker("refresh");
    })
}

function delete_user_upload_img(id) {
    let _data;
    _data = 'id=' + id;
    $.ajax({
        url: $(".btn_delete_image").data('url-post'),
        data: _data,
        type: 'POST',
        datatype: '',
        catch: false,
        success: function (data) {
            result = JSON.parse(data);
        }
    });
    //remove ảnh đi
    $('.div_img_upload_' + id).remove();

}

$(function () {
    tinymce.init({
        selector: '#mytextarea',
        height: 350,
        // menubar : false ,
        'code': false,
        plugins: [
            " lists link ",
        ],
        toolbar: 'undo redo  | ' +
            'bold italic forecolor  | alignleft aligncenter ' +
            'alignright alignjustify | ' +
            'removeformat | help ' +
            '| link',
        content_css: '//www.tiny.cloud/css/codepen.min.css'

    });

})

function dongho() {
    var time = new Date();
    var gio = time.getHours();
    var phut = time.getMinutes();
    var giay = time.getSeconds();

    if (gio < 10) {
        gio = "0" + gio;
    }
    if (phut < 10) {
        phut = "0" + phut;
    }
    if (giay < 10) {
        giay = "0" + giay;
    }
    document.getElementById("time").innerHTML = gio + ":" + phut + ":" + giay;
    setTimeout("dongho()",1000);
}
dongho();