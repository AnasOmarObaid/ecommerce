$(document).ready(function () {
    // remove tha all input when i click the btn
    $('.remove_btn_input').on('click', function () {
        $('.allow-delete .form-group select').val(null).trigger('change');
        $('.allow-delete .form-group input').val('');
        $('textarea').val(' ');

        $('html, body').animate({
            scrollTop: 0
        }, 100);
    }); //-- end remove input


    // image preview
    $(".image-preview").change(function () {
        let input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.image-area').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }); //-- end change function

});
