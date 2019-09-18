(function($){
  $(function(){

    $('.sidenav').sidenav();

  }); // end of document ready
})(jQuery); // end of jQuery name space

$( document ).ready(function(){

// Add class to ul parent
$('#primary-menu').addClass('hide-on-med-and-down');

// Add to sub menus unique ID
$( ".sub-menu" ).each(function(index) {
    $(this).addClass( "dropdown-content" );
    $(this).attr('id', 'dropdown' + index);
});

// Get li parents, identify which have sub-menus
$( "ul#primary-menu li.menu-item-has-children > a" ).each(function(index) {
    $(this).addClass('dropdown-button');
    $(this).attr('data-activates', 'dropdown' + index);
});

// Configure dropdown
$(".dropdown-button").dropdown({
    hover: false
});
});