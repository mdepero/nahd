(function($){
    $.fn.scrollingTo = function( opts ) {
        var defaults = {
            animationTime : 1000,
            easing : '',
            callbackBeforeTransition : function(){},
            callbackAfterTransition : function(){}
        };

        var config = $.extend( {}, defaults, opts );

        $(this).click(function(e){
            var eventVal = e;
            e.preventDefault();

            var $section = $(document).find( $(this).data('section') );
            if ( $section.length < 1 ) {
                return false;
            };

            if ( $('html, body').is(':animated') ) {
                $('html, body').stop( true, true );
            };

            var scrollPos = $section.offset().top;

            if ( $(window).scrollTop() == scrollPos ) {
                return false;
            };

            config.callbackBeforeTransition(eventVal, $section);

            $('html, body').animate({
                'scrollTop' : (scrollPos+'px' )
            }, config.animationTime, config.easing, function(){
                config.callbackAfterTransition(eventVal, $section);
            });
        });
    };
}(jQuery));



jQuery(document).ready(function(){
	"use strict";
	new WOW().init();


(function(){
 jQuery('.smooth-scroll').scrollingTo();
}());

});




$(document).ready(function(){




    $(window).scroll(function () {
        if ($(window).scrollTop() > 50) {
            $(".navbar-brand a").css("color","#fff");
            $("#top-bar").removeClass("animated-header");
        } else {
            $(".navbar-brand a").css("color","inherit");
            $("#top-bar").addClass("animated-header");
        }
    });

    $("#clients-logo").owlCarousel({
 
        itemsCustom : false,
        pagination : false,
        items : 5,
        autoplay: true,

    });


    $(document).on("click", ".check", function(e) {
        var link = $(this).attr("href"); // "get" the intended link in a var
        e.preventDefault();    
        bootbox.confirm("Are you sure?", function(result) {    
            if (result) {
                document.location.href = link;  // if result, "set" the document location       
            }    
        });
    });


    $('.option').click(function(e){

        var target = $('#'+$(this).attr('option-for'));

        var value = $(this).attr('option-val')

        if(target.val() == '') target.val(value);
        else target.val(target.val() + ', '+value);
    });


    $('.add-concern').click(add_concern);

    $('.delete-concern').click(delete_concern);



    //$('input[type=text]').first().focus();

});






var newCounter = 0;

function add_concern(e){
    var area_id = $(this).attr('area-id');
    var option_label = $(this).attr('option-label');


    $('#'+area_id+'_item').append('<input type="text" class="form-control x_con_new_'+newCounter+'" name="new_conc[]" value="'+option_label+'">');

    $('#'+area_id+'_item').append('<input type="hidden" class="form-control x_con_new_'+newCounter+'" name="new_conc_area[]" value="'+area_id+'">');


    $('#'+area_id+'_loc').append('<input type="text" class="form-control x_con_new_'+newCounter+'" name="new_conc_loc[]" value="">');

    $('#'+area_id+'_urg').append('<input type="text" class="form-control x_con_new_'+newCounter+'" name="new_conc_urg[]" value="">');

    $('#'+area_id+'_del').append('<button type="button" class="delete-concern new-concern btn btn-warning ion-trash-b x_con_new_'+newCounter+'" to-delete="new_'+newCounter+'"></button>');

    newCounter++;

    // need to re-add binding each time a new delete button is added
    $('.delete-concern').click(delete_concern);
}


function delete_concern(e){

    var tag = $(this).attr('to-delete');

    if(!$(this).hasClass('new-concern')){
        // must delete this from database
        $('#section-form').append('<input type="hidden" name="conc_delete[]" value="'+tag+'">');
    }

    $('.x_con_'+tag).remove();
}



// fancybox
$(".fancybox").fancybox({
    padding: 0,

    openEffect : 'elastic',
    openSpeed  : 450,

    closeEffect : 'elastic',
    closeSpeed  : 350,

    closeClick : true,
    helpers : {
        title : { 
            type: 'inside' 
        },
        overlay : {
            css : {
                'background' : 'rgba(0,0,0,0.8)'
            }
        }
    }
});






 




