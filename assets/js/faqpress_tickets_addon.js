(function ($) {


	$(function() {

		// Private Credentials POP UP
        $('.btn-credential').on('click', function (e) {
            e.preventDefault();
            $('.faq-pc-modal').addClass('open');
        });

        $('.faq-pc-modal .faq-close-btn').on('click', function (e) {
            e.preventDefault();
            $('.faq-pc-modal').removeClass('open');
        });

    });


    // my tickets search ajax

    var searchRequest = null;
    jQuery(function () {
      var minlength = 3;

      jQuery("#tickets-search").keyup(function () {
        var that = this,
        value = jQuery(this).val();

        if (value.length >= minlength ) {
          if (searchRequest != null) 
            searchRequest.abort();
        searchRequest = jQuery.ajax({
            type: "POST",
            url: faq_ajax.ajaxurl,
            data: {

              action: 'robodesk_ticket_my_tickets_search',
              search_keyword : value

          },
          dataType: "html",
          success: function(data){
              if (value== "" ) {
                jQuery('#tickets_datafetch').html();
                return;
            }
            else{
                jQuery('#tickets_datafetch').html(data);
            }
        }
    });
    }
    else{
     jQuery('#tickets_datafetch').empty();
 }
});
  });

})(jQuery);



