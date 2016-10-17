$(document).ready(function(){
    $('.accordion__title').click(function(){
        $(this).toggleClass('accordion__title_active');
        $(this).next('.accordion__content').slideToggle(400);
    });
    console.log('1111111');
});
