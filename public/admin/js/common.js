$(document).ready(function () {
    $('a').each(function() {
        if($(this).attr('href') === location.pathname){
            $(this).parent().addClass('active');
        }
    });


    $('input').each(function () {
        if($(this).prop('required')){
            $(this).labels().append('<span>*Обязательно</span>')
        }
    })
});