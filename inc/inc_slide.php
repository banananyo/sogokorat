<div style="margin-left:0px; margin-right:0px;">
    <div id="slide-main" class="owl-carousel owl-theme">

      <div class="item"><img src="images/banner.jpg" alt="" /></div>
      <div class="item"><img src="images/banner2.jpg" alt="" /></div>
</div>

    </div><!--slide-main-->
</div><!--row-->
<script>
$(document).ready(function() {
  $("#slide-main").owlCarousel({

      navigation : false, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
	  autoPlay:true
      // "singleItem:true" is a shortcut for:
      // items : 1,
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
  });
});
</script>