(function($) {

  Drupal.behaviors.morecomments = {
    attach: function() {
      var pager = Drupal.settings.morecomments_pager;
      // Replace the default pager with the more comments pager
      $("#comments .pager").replaceWith(pager);

       $(".morecomments-button").waypoint(function() {
				//alert("Hi");
   	    		morecomments_load();
		},{
    		offset: '100%'
		});

      function morecomments_load(event) {
        var classes = $(".morecomments-button").attr("class");
		//alert(classes);
        var info = classes.match("node-([0-9]+) page-([0-9]+)");
        $(".morecomments-button").append("<div class = 'wait'>&nbsp;</div>");
        $.get(Drupal.settings.basePath + "morecomments/" + info[1] + "/" + info[2], function(data) {
          $(".morecomments-button").replaceWith(data);
        });
      }
    }
  };

})(jQuery);
