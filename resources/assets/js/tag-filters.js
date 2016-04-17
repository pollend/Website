$(document).ready(function(){
    function filter(){
        var uri = window.location.href.split('?')[0]+'/filter?'+$('#list-filters').find('form').serialize();
        var pushUri = window.location.href.split('?')[0]+'?'+$('#list-filters').find('form').serialize();
        $.get(uri, function(response){
            $('#content').html(response);
        });

        history.pushState({}, '', pushUri);
    }

    $('#list-filters').find('input').each(function(key, input){
        $(input).on('change slide', filter);
    });

    $('#sliders').find('input').each(function(key, input){
        var s = new Slider(input);

        s.on('change', function () {
            $(input).siblings('.filter-value').text(s.getValue());
            filter();
        });
    });

    $('.tag-filter').each(function(key, tagFilter){
        $(tagFilter).find('.btn-success').click(function(){
            $(this).toggleClass('active');
            $(this).siblings('.btn-danger').removeClass('active');

            var val = '';

            if($(this).hasClass('active')) {
                val = 'on'
            }

            $(this).parents('.tag-filter').find('input[type=hidden]').val(val);
            $(this).parents('.tag-filter').find('input[type=hidden]').change();
        });

        $(tagFilter).find('.btn-danger').click(function(){
            $(this).toggleClass('active');
            $(this).siblings('.btn-success').removeClass('active');

            var val = '';

            if($(this).hasClass('active')) {
                val = 'off'
            }

            $(this).parents('.tag-filter').find('input[type=hidden]').val(val);
            $(this).parents('.tag-filter').find('input[type=hidden]').change();
        });
    });
});
