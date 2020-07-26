$(function () {






    // Not essential functionality - for demonstration purposes only
    $(document).on('change', '[type=radio]', function (e) {
        // Update display of the currently selected value whenever it's changed
        if ($(this).is(':checked')) {
            $('#display_selected').text($(this).val());
        }
    }).ready(function () {
        // Display the initial selected value (should be zero)
        $('input').trigger('change');
    });

    //   


    //   $('.header nav form input').on('focus',function(){
    //     $('.header nav form .animation').css('width' , '100%')
    //   });
});

(function ($) {
    "use strict";
    $.fn.InputSpinner = function (options) {

        const config = {
            decrementButton: "<strong>-</strong>", // button text
            incrementButton: "<strong>+</strong>", // ..
            groupClass: "input-group-spinner", // css class of the input-group
            buttonsClass: "btn-outline-secondary",
            buttonsWidth: "2.5em",
            textAlign: "center",
            autoDelay: 500, // ms holding before auto value change
            autoInterval: 100, // speed of auto value change
            boostThreshold: 15, // boost after these steps
            boostMultiplier: 2,
            locale: null // detects the local from `navigator.language`, if null
        };
        Object.assign(config, options);

        const html = '<div class="input-group ' + config.groupClass + '">' +
            '<div class="input-group-prepend">' +
            '<button style="min-width: ' + config.buttonsWidth + '" class="btn btn-decrement ' + config.buttonsClass + '" type="button">' + config.decrementButton + '</button>' +
            '</div>' +
            '<input style="text-align: ' + config.textAlign + '" class="input"/>' +
            '<div class="input-group-append">' +
            '<button style="min-width: ' + config.buttonsWidth + '" class="btn btn-increment ' + config.buttonsClass + '" type="button">' + config.incrementButton + '</button>' +
            '</div>' +
            '</div>';

        this.each(function () {

            const $original = $(this);
            $original.hide();

            var autoDelayHandler = null;
            var autoIntervalHandler = null;

            const $inputGroup = $(html);
            const $buttonDecrement = $inputGroup.find(".btn-decrement");
            const $buttonIncrement = $inputGroup.find(".btn-increment");
            const $input = $inputGroup.find("input");

            const min = parseFloat($original.prop("min")) || 0;
            const max = parseFloat($original.prop("max")) || Infinity;
            const step = parseFloat($original.prop("step")) || 1;
            const decimals = parseInt($original.attr("data-decimals")) || 0;

            const locale = config.locale || getLanguage();

            const numberFormat = new Intl.NumberFormat(locale, {
                minimumFractionDigits: decimals
            });

            var value = parseFloat($original.val());

            $original.after($inputGroup);
            $input.val(numberFormat.format(value));

            var boostCount = 0;

            $input.on("paste keyup change", function () {
                value = parseInt($input.val().replace(/[.,]/g, ''), 10); // i18n
                value = value / Math.pow(10, decimals);
                value = Math.round(value / step) * step;
            });

            onPointerDown($buttonDecrement[0], function () {
                stepHandling(-step);
            });

            onPointerDown($buttonIncrement[0], function () {
                stepHandling(step);
            });

            onPointerUp(document.body, function () {
                resetTimer();
            });

            function stepHandling(step) {
                calcStep(step);
                resetTimer();
                autoDelayHandler = setTimeout(function () {
                    autoIntervalHandler = setInterval(function () {
                        if (boostCount > config.boostThreshold) {
                            calcStep(step * config.boostMultiplier);
                        } else {
                            calcStep(step);
                        }
                        boostCount++;
                    }, config.autoInterval);
                }, config.autoDelay);
            }

            function calcStep(step) {
                value = Math.min(Math.max(value + step, min), max);
                $input.val(numberFormat.format(value));
            }

            function resetTimer() {
                boostCount = 0;
                clearTimeout(autoDelayHandler);
                clearTimeout(autoIntervalHandler);
            }

        });

    };

    function onPointerUp(element, callback) {
        element.addEventListener("mouseup", function (e) {
            // e.preventDefault();
            callback(e);
        });
        element.addEventListener("touchend", function (e) {
            // e.preventDefault();
            callback(e);
        });
    }

    function onPointerDown(element, callback) {
        element.addEventListener("mousedown", function (e) {
            e.preventDefault();
            callback(e);
        });
        element.addEventListener("touchstart", function (e) {
            e.preventDefault();
            callback(e);
        });
    }

    function getLanguage() {
        if (navigator.languages !== undefined) {
            return navigator.languages[0];
        } else {
            return navigator.language;
        }
    }

}(jQuery));

$("input[type='number']").InputSpinner();


function login_model() {
    $('#login-model').modal('show');
};

function register_model() {
    $('#login-model').modal('hide');

    $('#register-model').modal('show');

};

function forget_model() {
    $('#login-model').modal('hide');

    $('#forget-model').modal('show');

};
$('.header .loginReg .modal-body form .form-group .hide').on('click', function (e) {

    if ($(this).siblings('input').attr('type') == 'text') {
        $(this).siblings('input').attr('type', 'password');
        $(this).css('color', 'rgba(40, 47, 54, 0.3)')

    } else {
        $(this).siblings('input').attr('type', 'text');
        $(this).css('color', 'var(--main-color)')


    }

});

//load jquery first
$(document).ready(function () {
    //save menu height because fixed element height is not counted on page
    var menuHeight = $('.fixed-menu').outerHeight();
    //add its height as padding to content
    //click function  
    $(".scroll-btn").on("click", function (e) {
        // clear default link behavour
        e.preventDefault();
        //save cliked link href atribute
        var target = $(this).attr('href');
        //save podition top of tagget element
        var position = $(target).offset().top;
        //animate page, easy scroll to distanation except menu height
        $("html, body").animate({
            scrollTop: position - 40
        }, '500');
        return false;
    });

});


$(document).ready(function () {

    $('.packages-inputs .custom-control').click(function () {
        var tab_id = $(this).attr('data-tab');

        $('.packages-inputs .custom-control').removeClass('current');
        $('.packages-content .panel').removeClass('current');

        $(this).addClass('current');
        $("#" + tab_id).addClass('current');
    })

});


(function ($, window, document, undefined) {
    $('.inputfile').each(function () {
        var $input = $(this),
            $label = $input.next('label'),
            labelVal = $label.html();

        $input.on('change', function (e) {
            var fileName = '';

            if (e.target.value)
                fileName = e.target.value.split('\\').pop();

            if (fileName) {
                $label.siblings('.buttonBottom').find('strong').html(fileName);


                $(this).siblings('.buttonBottom').find('.closec').fadeIn();

            } else
                $label.html(labelVal);

        });

        $(this).siblings('.buttonBottom').find('.closec').on('click', function () {
            $(this).parent().siblings('input').val("");
            $(this).parent().siblings('label').children('span').text('Computer');
            $('.disdis').prop('disabled', false);

            $(this).fadeOut();
            $(this).siblings('strong').text('');
        });

        // Firefox bug fix
        $input
            .on('focus', function () {
                $input.addClass('has-focus');
            })
            .on('blur', function () {
                $input.removeClass('has-focus');
            });

    });

    // product cart price
    $(document).ready(function () {

        $(document).on('click', '.quantity .input-group', function () {
            //  $(this).parent().find('').html();

            $($(this).siblings('input').data('id')).html(Number($(this).siblings('input').data('price')) * Number($(this).children('.input').val()) + '$');

            $(this).siblings('input').attr('value', $(this).children('.input').val());


            calcTotal();
        });
    });


    function calcTotal() {
        'use strict';

        var totalPrice = 0;
        $('.table-r tr').each(function () {

            totalPrice += Number($(this).find('.product_price').html().replace(/[_\W]+/g, ""));
        });

        $('#total-price').html(totalPrice + '$');

        $('.total_input').attr('value', $('#total-price').html());
        // console.log(totalPrice);

    } //-- end calcTotal


    // image preview
    $(".image-preview").change(function () {
        let input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.image-area').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        } //-- end imag preview
    }); //-- end change function

    // start quantity
    $('.custom_form').on('submit', function (e) {

        $('.custom_quantity').attr('value', $('.input').val());
    }); //-- end submit
})(jQuery, window, document);
