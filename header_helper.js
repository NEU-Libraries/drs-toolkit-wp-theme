jQuery(document).ready(function(){
  jQuery(".site-branding").removeClass("col-md-4").addClass("col-lg-6");
  jQuery("#site-navigation").removeClass("col-md-8").addClass("col-lg-6");
  if (Modernizr.touch) {
    $("#site-navigation .menu-item-has-children.dropdown").removeClass('menu-item-has-children').removeClass('dropdown');
  }
})
