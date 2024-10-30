
jQuery(document).ready(function(){

    jQuery('ul.nav-tab-wrapper li').click(function(){
        var tab_id = jQuery(this).attr('data-tab');
        jQuery('ul.nav-tab-wrapper li').removeClass('nav-tab-active');
        jQuery('.tab-content').removeClass('current');
        jQuery(this).addClass('nav-tab-active');
        jQuery("#"+tab_id).addClass('current');
    });
});
jQuery(document).ready(function()
{
	jQuery('.bpsfw_select_product').select2({
  	    ajax:{
			url: ajaxurl,
			dataType: 'json',
			allowClear: true,
			data: function (params) {
				return {
    				q: params.term,
    				action: 'wg_product_ajax'
  				};
  			},
			processResults: function( data ) {
				var options = [];
				if ( data ) {

 					jQuery.each( data, function( index, text ) { 
						options.push( { id: text[0], text: text[1], 'price': text[2]} );
					});

 				}
				return {
					results: options
				};
			},
			cache: true
		},
		minimumInputLength: 1
	});

	jQuery('.bpsfw_select_cats').select2({
        ajax: {
            url: ajaxurl,
            dataType: 'json',
            delay: true,
            data: function (params) {
                return {
                    q: params.term,
                    action: 'wg_cats_ajax'
                };
            },
            processResults: function( data ) {
                var options = [];
                if ( data ) {
 
                    jQuery.each( data, function( index, text ) {
                        options.push( { id: text[0], text: text[1],'price': text[2]} );
                    });
 
                }
                return {
                    results: options
                };
            },
            cache: true
        },
        minimumInputLength: 0
    });

    jQuery('.bpsfw_select_tags').select2({
        ajax: {
            url: ajaxurl,
            dataType: 'json',
            delay: true,
            data: function (params) {
                return {
                    q: params.term,
                    action: 'wg_tags_ajax'
                };
            },
            processResults: function( data ) {
                var options = [];
                if ( data ) {
 
                    jQuery.each( data, function( index, text ) {
                        options.push( { id: text[0], text: text[1],'price': text[2]} );
                    });
 
                }
                return {
                    results: options
                };
            },
            cache: true
        },
        minimumInputLength: 0
    });

    jQuery('.wg_select_pags').select2({
        ajax: {
            url: ajaxurl,
            dataType: 'json',
            delay: true,
            data: function (params) {
                return {
                    q: params.term,
                    action: 'wg_pages_ajax'
                };
            },
            processResults: function( data ) {
                var options = [];
                if ( data ) {

                    jQuery.each( data, function( index, text ) {
                        options.push( { id: text[0], text: text[1],'price': text[2]} );
                    });

                }
                return {
                    results: options
                };
            },
            cache: true
        },
        minimumInputLength: 0
    });

    if(jQuery(".whole_web_check").is(":checked")){ 
        jQuery(".product_private ").hide();
    }

    jQuery(".whole_web_check").click(function() {
        if(jQuery(this).is(":checked")) {
            jQuery(".product_private").hide(500);
        } else {
            jQuery(".product_private").show(500);
        }
    });

});

