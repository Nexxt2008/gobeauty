jQuery.noConflict();
(function($) {
    $(function() {
        /*** Nav Tabs ***/
        
        var hash = window.location.hash;
        if (hash.length !== 0) {
            $('.nav-tabs li a[href="' + hash +'"]').click();
            if (hash == "#qa") {
                $('#subscribing').hide();
            }
        }

        $('.nav-tabs').css('border-color', $('.nav-tabs li.active a').css('background-color'));

        $('.nav-tabs li a').click(function(){
            $('.nav-tabs').css('border-color', $(this).css('background-color'));
            if(history.pushState) {
                history.pushState(null, null, $(this).attr('href'));
            } else {
                location.hash = $(this).attr('href');
            }
            if ($(this).attr('href') == "#qa") {
                $('#subscribing').hide();
            } else {
                $('#subscribing').show();
            }
        });

        /*** View mode ***/

        if ( $.cookie('mode') == 'grid' ) {
            grid_update();
        } else if ( $.cookie('mode') == 'list' ) {
            list_update();
        }

        $('#mode').toggle(
            function(){
                if ( $.cookie('mode') == 'grid' ) {
                    $.cookie('mode','list');
                    list();
                } else {
                    $.cookie('mode','grid');
                    grid();
                }
            },
            function(){
                if ( $.cookie('mode') == 'list') {
                    $.cookie('mode','grid');
                    grid();
                } else {
                    $.cookie('mode','list');
                    list();
                }
            }
        );

        function grid(){
            $('#mode').addClass('flip');
            $('.tab-pane.active')
                .fadeOut('fast', function(){
                    grid_update();
                    $(this).fadeIn('fast');
                })
            ;
        }

        function list(){
            $('#mode').removeClass('flip');
            $('.tab-pane.active')
                .fadeOut('fast', function(){
                    list_update();
                    $(this).fadeIn('fast');
                })
            ;
        }

        function grid_update(){
            $('.tab-pane.active').addClass('grid').removeClass('list');
            $('.tab-pane.active').find('.thumb img').attr({'width': '190', 'height': '190'});
            $('.tab-pane.active').find('.post')
                .mouseenter(function(){
                    $(this)
                        .css('background-color','#FFEA97')
                        .find('.thumb').hide()
                        .css('z-index','-1');
                })
                .mouseleave(function(){
                    $(this)
                        .css('background-color','#f5f5f5')
                        .find('.thumb').show()
                        .css('z-index','1');
                });
            $('.tab-pane.active').find('.post').click(function(){
                location.href=$(this).find('h2 a').attr('href');
            });
            $.cookie('mode','grid');
        }

        function list_update(){
            $('.tab-pane.active').addClass('list').removeClass('grid');
            $('.tab-pane.active').find('.post').removeAttr('style').unbind('mouseenter').unbind('mouseleave');
            $('.tab-pane.active').find('.thumb img').attr({'width': '290', 'height': '290'});
            $.cookie('mode', 'list');
        }

        /*** Ajax-fetching posts ***/

        $('.tab-pane.active .more a').live('click', function(e){
            e.preventDefault();
            $(this).addClass('loading').text('Loading...');
            $.ajax({
                type: "GET",
                url: $(this).attr('href') + '#loop',
                dataType: "html",
                success: function(out){
                    result = $(out).find('.tab-pane.active .post');
                    nextlink = $(out).find('.tab-pane.active .more a').attr('href');
                    //$('.tab-pane.active').append(result.fadeIn(300));
                    $(result.fadeIn(300)).insertBefore($('.tab-pane.active .clear-fix:last'));
                    $('.tab-pane.active .more a').removeClass('loading').text('View More');
                    if (nextlink != undefined) {
                        $('.tab-pane.active .more a').attr('href', nextlink);
                    } else {
                        $('.tab-pane.active .more').remove();
                    }
                    if ( $.cookie('mode') == 'grid' ) {
                        grid_update();
                    } else {
                        list_update();
                    }
                }
            });
        });

        /*** Misc ***/

        $('#comment, #author, #email, #url')
        .focusin(function(){
            $(this).parent().css('border-color','#888');
        })
        .focusout(function(){
            $(this).parent().removeAttr('style');
        });
        $('.rpthumb:last, .comment:last').css('border-bottom','none');

    })
})(jQuery)
