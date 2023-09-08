$(document).ready(function() {
    var $radioButtons = $('.memberships_item_block input[type="radio"]');
    $radioButtons.click(function() {
        $radioButtons.each(function() {
            $(this).parent().parent().parent().toggleClass('activecheckopt', this.checked);
        });
    });
    // 
    $("#up").on('click', function() {
        $("#incdec input").val(parseInt($("#incdec input").val()) + 1);
    });

    $("#down").on('click', function() {
        $("#incdec input").val(parseInt($("#incdec input").val()) - 1);
    });
    // 


    window.setTimeout(function() {
        $('.load-unread').addClass('load-read');
    }, 400);

    $(window).scroll(function() {
        var sticky = $('.header_outer'),
            scroll = $(window).scrollTop();

        if (scroll >= 80) {
            sticky.addClass('fixed');
        } else {
            sticky.removeClass('fixed');
        }
    });


    $(".menu-btn").on("click", function() {
        $(this).parent().toggleClass("activemenu");
    });

    $(".closeicon").click(function() {
        $(this).parent().parent().parent().toggleClass("activemenu");
    });

    $(".mob_user_icon").on("click", function() {
        $(this).toggleClass("activesidebar");
        $('.left_sidebar').toggleClass("activesidebar");
    });




    function mobileTabDropdown() {
        jQuery('.nav-tabs.mobile-tabs .nav-item').on('click', function() {
            jQuery(this).parent().prepend(jQuery(this));
            jQuery('.nav-tabs.mobile-tabs .nav-item').toggleClass('visible-xs visible-sm');
        });
    }

    if ($(window).width() < 992) {
        mobileTabDropdown();
    }

    $(window).resize(function() {
        if ($(window).width() < 992) {
            mobileTabDropdown();
        } else {
            jQuery('.nav-tabs.mobile-tabs .nav-item').off();
        }
    });

    // $("#demo-htmlselect").ddslick();

    $('.reset_capcha').click(function() {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function(data) {
                $(".capcha_img").html(data.captcha);
            }
        });
    });

});


const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#id_password');

if (togglePassword) {

    togglePassword.addEventListener('click', function(e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

}

const togglePassword2 = document.querySelector('#togglePassword2');
const password2 = document.querySelector('#id_password2');

if (togglePassword2) {

    togglePassword2.addEventListener('click', function(e) {
        const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
        password2.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

}


const togglePassword3 = document.querySelector('#togglePassword3');
const password3 = document.querySelector('#id_password3');

if (togglePassword3) {

    togglePassword3.addEventListener('click', function(e) {
        const type = password3.getAttribute('type') === 'password' ? 'text' : 'password';
        password3.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

}