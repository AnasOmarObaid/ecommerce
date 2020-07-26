$(document).ready(function () {

    var id = "";

    var product_price;

    var final_total = 0;
    // get product data
    $('.product-data').on('click', function (q) {
        q.preventDefault();

        product_price = $(this);

        var name = $(this).data('name');

        id = $(this).data('id');

        var quantity = $(this).data('quantity');

        var uniPrice = $(this).data('price');


        var html =
            `<tr id = "order_${id}">
                <td>${name}</td>
                <td><input type = "number"  data-quantity = ${quantity} data-stock = "#stock-product${id}" data-price = ${uniPrice} class = "form-control input-price input-sm" name = "quantity[${id}]" min = "1" value = "1" max = "${quantity}"/></td>
                <td data-price = "${uniPrice}" class = "product_price">${uniPrice}</td>
                <td><span class = "btn btn-sm btn-danger remove-order"  data-quantity = ${quantity}  data-stock = "#stock-product${id}" data-product = "${id}" style = "cursor:pointer"><i class = "fa fa-trash"></i></span></td>
            </tr>`;
        $('.table-head').append(html);

        $(this).addClass('disabled');



        $('#stock-product' + id).html(quantity - 1);

        calcTotal();
    }); //-- end of product data


    $('.remove-order').click(function () {


    });

    // remove product data
    $('body').on('click', '.remove-order', function () {

        $("#link-product" + $(this).data('product')).removeClass('disabled').addClass('btn-success');
        console.log($(this).data('product'));
        $('#order_' + $(this).data('product')).remove();
        var selector = $(this).data('stock');
        $(selector).html($(this).data('quantity'));

        calcTotal();
    }); //-- end of remove



    // before submit
    $('#order-submit').submit(function (e) {
        var tr = $('.table-head tr').length;
        if (tr == 0) {
            alert('You Must Add Order Before Click Here !');
            return false;
        }
        return true;
    }); //-- end submit



    // get data order
    $('.get-order').on('click', function (e) {
        e.preventDefault();
        var url = $(this).data('url');

        $('.lds-facebook').css('display', 'inline-block');
        $('.lds-facebook div').css('display', 'inline-block');

        $.ajax({
            url: url,
            method: 'get',
            success: function (data) {
                $('.lds-facebook').css('display', 'none');
                $('.lds-facebook div').css('display', 'none');
                $('#order-data').empty();
                $('#order-data').append(data);
            } //-- end success 
        }); //-- end ajax request
    }); //-- end get data order



    // checked btn
    var b = '';
    $('.btn-checked').on('click', function () {
        b = confirm('Do You Want To Delete It ?');
    }); //-- end checked btn

    // submit to destroy order
    $('.destroy-order').submit(function () {
        if (b == true)
            return true;
        return false;
    }); //-- end submit to destroy order


    // calculate the total price
    $('.edit-number').on('keyup change', function () {

        $('.total-edit-price').html(Number($(this).data('price')) * Number($(this).val()), 2);

    });
    //-- end calculate the total price
    // change the number 100 to 100.00
    $('.span-price').number(true, 2);



    // input price change
    $('body').on('keyup change', '.input-price', function () {
        var price = parseInt($(this).data('price'));
        var totalPrice = price * parseInt($(this).val());
        $(this).parent().next().html(totalPrice, 2);
        var selector = $(this).data('stock');
        var originalCount = parseInt($(this).data('quantity'));
        var bigValue = parseInt($(this).val()) + 1; //  6 then 7
        var smallValue = parseInt($(this).val()) - 1; // 5 then 6
        smallValue >= bigValue ? $(selector).html((parseInt($(selector).html()) + (1))) : $(selector).html(originalCount - parseInt($(this).val()));
        calcTotal();
    }); //-- end of input price


    function calcTotal() {
        'use strict';
        var totalPrice = 0;
        $('.table-head tr').each(function () {
            totalPrice += Number($(this).find('.product_price').html().replace(/,/g, ''));

        });
        $('#total-price').html(totalPrice, 2 + '$');

        totalPrice == 0 ? $('.btn-submit').addClass('disabled') : $('.btn-submit').removeClass('disabled');

    } //-- end calcTotal
}) //-- end ready function
