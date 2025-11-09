$(function () {
    $("#gotop").click(function () {
        jQuery("html,body").animate({
            scrollTop: 0
        }, 800);
    });
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('#gotop').fadeIn("fast");
        } else {
            $('#gotop').stop().fadeOut("fast");
        }
    });
});


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


// service
$(function () {
    $('.nav-link').click(
        function () {
            var sectionTo = $(this).attr('href');
            $('html, body').animate(
                {
                    scrollTop: $(sectionTo).offset().top
                        - $("#scrollblock1").outerHeight()
                        - 147
                }, 500);
        });

    $(document).on("scroll", function () {
        if ($(document).scrollTop() > 100) {
            $("#scrollblock1").addClass("scrollblock1-smaller");
        } else {
            $("#scrollblock1").removeClass("scrollblock1-smaller");
        }
    });
});

// // login.js
// $(function() {
//     $("form.login-form").on("submit", function(e) {
//         e.preventDefault();

//         var submitButton = $("input[type=submit]");
//         submitButton.attr("disabled", true);

//         $(document.body).css({'cursor' : 'wait'});

//         var _this = this;
//         grecaptcha.execute().then(function(token) {
//             _this["g-recaptcha-response"] = token;
//             _this.submit();
//         });
//     });
// });

// contactus.js
$(function() {
    $("form.contact_form").on("submit", function(e) {
      e.preventDefault();
      
      var submitButton = $("button[type=submit]");
      submitButton.attr("disabled", true);
      
      $(document.body).css({'cursor' : 'wait'});
      
      var _this = this;
      grecaptcha.execute().then(function(token) {
        _this["g-recaptcha-response"] = token;
        _this.submit();
      });
    });

    $('[data-toggle="tooltip"]').tooltip();
  });