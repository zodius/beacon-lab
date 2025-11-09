$(function () {
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-714WVG1190');
});

$(function () {
    let currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    $('#com-copyright-year-id').text(currentYear);
});

// header 
$(function () {
    const productIdList = ['network-endpoint-security-product-id', 'vulnerability-scan-product-id', 'access-control-id',
        'security-management-product-id', 'backup-product-id'];

    productIdList.forEach(ele => {
        const productMoreId = ele + '-more';
        $(`#${productMoreId}`).hide();
    });


    const securityProductId = 'all-security-product-id';
    $('.headline-more-content').click(function () {
        const productId = $(this).attr('id');
        const productMoreId = productId + '-more';

        if (productIdList.includes(productId)) {
            $(`#${securityProductId}`).hide();
            $(`#${productMoreId}`).show();
        }
    });
    $('.headline-to-back').click(function () {
        productIdList.forEach(ele => {
            $(`#${ele}-more`).hide();
        });
        $(`#${securityProductId}`).show();
    });
});

// header 
$(function () {
    $(".mega-dropdown").hover(function () {
        $(this).addClass('hv_active');
    }, function () {
        $(this).removeClass('hv_active');
    });

    $(document).on("scroll", function () {
        if ($(document).scrollTop() > 100) {
            $("#nav_logo").addClass("scroll-smaller")
        } else {
            $("#nav_logo").removeClass("scroll-smaller")
        }
    });
});

$(function () {

    $(document).on("scroll", function () {
        if ($(document).scrollTop() > 100) {
            $("#scrollblock1").addClass("scrollblock1-smaller");
        } else {
            $("#scrollblock1").removeClass("scrollblock1-smaller");
        }
    });
});

let token = $("meta[name='_csrf']").attr("content");
let header = $("meta[name='_csrf_header']").attr("content");

let myHeaders = {};
myHeaders['X-CSRF-TOKEN'] = "[[${_csrf.token}]]";

$.ajaxSetup({
    headers: myHeaders
});

$(document).ajaxSend(function (e, xhr, options) {
    xhr.setRequestHeader(header, token);
});
