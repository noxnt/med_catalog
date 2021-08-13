require('./bootstrap');


$(function () {
    let form = $('.page-form');
    let select = $('.page-select');

    select.change(function(){
        $(form).submit();
    });
});

