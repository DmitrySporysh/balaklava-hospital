$( document ).ready(function() {
    function changeBgEffect() {
        var steps = [1,2,3],// указываете шаги через запятую
            i = 0,
            path = '/development/img/login/login-bg',//путь к картинке / общее название картинок (image или любое другое)

            timeout = setTimeout(function slide(){
                var step = steps[i-1];
                $('#bg_change').css('background-image','url(' + path + (i+1) + '.jpg)')

                if (i < steps.length - 1)
                    i++;
                else
                    i=0;
                timeout = setTimeout(slide, 4000);
            },0)
    }
    changeBgEffect();
});