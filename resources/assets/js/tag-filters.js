$(document).ready(function(){
    function filter(){
        $.get(window.location.href.split('?')[0]+'?'+$('#list-filters').find('form').serialize(), function(response){
            $('#content').html($(response).find('#content').html());
        });
    }

    $('#list-filters').find('input').each(function(key, input){
        $(input).on('change slide', filter);
    });

    $('#sliders').find('input').each(function(key, input){
        console.log('test');

        var s = new Slider(input, {
            formatter: function(value) {
                return 'dgsdfg value: ' + value;
            }
        });

        s.on('change', filter);
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
