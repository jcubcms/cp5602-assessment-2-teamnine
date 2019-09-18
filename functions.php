<?php

// Cleans wp_head of extra trash

function headOptimize()
{

	// Removes extra stuff that wordpress adds into head

	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_shortlink_wp_head');
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);

	// Adds admin filters

	add_filter('the_generator', '__return_false');

	// Removes DNS link in header

	remove_action('wp_head', 'wp_resource_hints', 2);

	// Removes Emojis

	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');

	// Removes API link in headCleanup

	remove_action('wp_head', 'rest_output_link_wp_head');
}

add_action('after_setup_theme', 'headOptimize');

// Stops the formating when HTML is added in the WYSIWYG editor

function WYSIWYGFormat()
{
	add_theme_support('post-thumbnails');

}

WYSIWYGFormat();

// Add any libraries or JS and CSS dependencies here

function includeLibraries()
{

	// Jquery 2.1.1

	wp_deregister_script('jquery');
	wp_register_script('jquery', get_template_directory_uri() . '/assets/js/jquery-2.1.1.min.js', false, NULL, true);
	wp_enqueue_script('jquery');

	// Materialize CSS -  http://materializecss.com/

	wp_enqueue_style('materialize', Get_template_directory_uri() . '/materialize/css/materialize.css');
	wp_enqueue_script('materialize_js', Get_template_directory_uri() . '/materialize/js/materialize.js', '', '', true);
	wp_enqueue_script('init_js', Get_template_directory_uri() . '/materialize/js/init.js', '', '', true);

	// NodeGarden JS - http://nodegardenjs.org

	wp_enqueue_style('nodegarden', Get_template_directory_uri() . '/nodegarden/css/main.css');
	wp_enqueue_script('nodegardenjs', Get_template_directory_uri() . '/nodegarden/js/main.js', '', '', true);
}

add_action('wp_enqueue_scripts', 'includeLibraries');

// Enqueue any extra custom JS or CSS files here

function themeScripts()
{
  // Full Height Containers
  wp_enqueue_script('fullheight_scripts', Get_template_directory_uri() . '/assets/js/fullHeight.js', '', '', true);
	// Navigation
	wp_enqueue_script('Navigation_scripts', Get_template_directory_uri() . '/assets/js/navigation.js', '', '', true);
}

add_action('wp_enqueue_scripts', 'themeScripts');

// Register navigation menu locations

register_nav_menus(array(
	'primary' => __('Primary Menu')
));
register_nav_menus(array(
	'footer-menu' => __('Footer Menu')
));

// Register footer widgets

// Custom Function Wordpress

if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Footer',
    'before_widget' => '<div class = "widgetizedArea">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);

function reg_cat() {
         register_taxonomy_for_object_type('class_type','classes');
}
add_action('init', 'reg_cat');


function wpb_custom_new_menu() {
  register_nav_menus(
    array(
      'my-custom-menu' => __( 'My Custom Menu' ),
      'extra-menu' => __( 'Extra Menu' )
    )
  );
}
add_action( 'init', 'wpb_custom_new_menu' );

add_theme_support( 'custom-logo', array(
	'height'      => 75,
	'width'       => 150,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( 'site-title', 'site-description' ),
) );


add_theme_support('custom-header', array(
    'default-image' => '', // set default header image
    'width' => 1500, // set the width for header image
    'height' => 500, // set the height for header image
    'flex-height' => true, // enable flex height
    'flex-width' => true, // enable flex width
));

//

function sidebars()
{

	// Footer Section 1

	register_sidebar(array(
		'name' => ('Footer Area 1') ,
		'id' => 'footer1',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgetTitle">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => ('Footer Area 2') ,
		'id' => 'footer2',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgetTitle">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => ('Footer Area 3') ,
		'id' => 'footer3',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgetTitle">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => ('Footer Area 4') ,
		'id' => 'footer4',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgetTitle">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => ('Blog') ,
		'id' => 'blogarchive',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgetTitle">',
		'after_title' => '</h3>'
	));
}

add_action('widgets_init', 'sidebars');

function display_posts()
{
	global $post;
	$tonyShortcode = "";
	$tonyShortcode.= "<div class='row'>";
	$my_query = new WP_Query(array(
		'post_type' => 'post',
		'posts_per_page' => 2
	));
	if ($my_query->have_posts()):
		while ($my_query->have_posts()):
			$my_query->the_post();
			$tonyShortcode.= "<div class='col s12 m4'>";
			$tonyShortcode.= "<div class='card '>";
			$tonyShortcode.= "<div class='card-image waves-effect waves-block waves-light'>";
			$tonyShortcode.= "<a href='" . get_permalink() . "'>";
			$tonyShortcode.= "<img src='" . get_the_post_thumbnail_url() . "' />";
			$tonyShortcode.= "</a>";
			$tonyShortcode.= "</div>";
			$tonyShortcode.= "<div class='card-content'>";
			$tonyShortcode.= "<div class='card-title'>";
			$tonyShortcode.= "<h2>" . get_the_title() . " </h2>";
			$tonyShortcode.= "</div>";
			$tonyShortcode.= "<p>" . get_the_excerpt() . "</p>";
			$tonyShortcode.= "<a href='" . get_permalink() . "' class= 'waves-effect waves-light btn blogBtn '>Read more</a>";
			$tonyShortcode.= "</div>";
			$tonyShortcode.= "</div>";
			$tonyShortcode.= "</div>";
		endwhile;
		wp_reset_postdata();
	endif;
	$tonyShortcode.= "</div>";
	return $tonyShortcode;
}

add_shortcode('displayposts', 'display_posts');

// Save the Metabox Data

function Classes_saveCustomMeta($post_id, $post)
{

	// Check for nonce

	$checkNonce = !wp_verify_nonce($_POST['eventmeta_noncename'], plugin_basename(__FILE__));

	// User can edit

	$userEdit = !current_user_can('edit_post', $post->ID);

	// Validate user

	if ($checkNonce and $userEdit) {
		return $post->ID;
	}

	// We'll put it into an array to make it easier to loop though.

	$Classes_Meta['_client_name'] = $_POST['_client_name'];
	$Classes_Meta['_problem'] = $_POST['_problem'];
	$Classes_Meta['_description'] = $_POST['_description'];
	$Classes_Meta['_solution'] = $_POST['_solution'];

	// Add values of $events_meta as custom fields

	foreach($Classes_Meta as $key => $value) {
		if ($post->post_type == 'revision') {
		}

		if (get_post_meta($post->ID, $key, FALSE)) {
			update_post_meta($post->ID, $key, $value);
		}
		else {
			add_post_meta($post->ID, $key, $value);
		}

		if (!$value) {
			delete_post_meta($post->ID, $key);
		}
	}
}

add_action('save_post', 'Classes_saveCustomMeta', 1, 2); // save the custom fields

// Add transparent header box options

function init_themeOption()
{
	$screens = array(
		'post',
		'page',
		'case'
	);
	foreach($screens as $screen) {
		add_meta_box('create_themeOption', __('Transparent Header', 'layerswp') , 'create_themeOption', $screen, 'side', 'low');
	}
}

add_action('add_meta_boxes', 'init_themeOption');

// Create HTML for Classes custom meta fields

function create_themeOption()
{
	global $post;

	// Noncename needed to verify where the data originated

	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';

	// Get the value if its already been entered
	$_headerColor = get_post_meta($post->ID, '_headerColor', true);
  $_trans = get_post_meta($post->ID, '_trans', true);

  // Returns previously selected value
  if ($_headerColor == 'dark') { // Header Color Palatte
		$isDark = 'selected';
	}
	else {
		$isLight = 'selected';
	}
  if ($_trans == 'on') { // Transparent header
		$isOn = 'selected';
	}
	else {
		$isOff = 'selected';
	}

  // HTML Rendered on admin
  echo '<div class=""><h3>Transparent Header</h3>';
	echo '<select style="width:100%;" name="_trans">';
  echo '<option value="off" ' . $isOff . ' >Off</option>';  
	echo '<option value="on" ' . $isOn . '>On</option>';
	echo '</select></div>';
	echo '<div class=""><h3>Light or Dark Header</h3>';
	echo '<select style="width:100%;" name="_headerColor">';
	echo '<option value="dark" ' . $isDark . '>Dark</option>';
	echo '<option value="light" ' . $isLight . '>Light</option>';
	echo '</select></div>';

}

function save_themeOption($post_id, $post)
{

	// Check for nonce

	$checkNonce = !wp_verify_nonce($_POST['eventmeta_noncename'], plugin_basename(__FILE__));

	// User can edit

	$userEdit = !current_user_can('edit_post', $post->ID);

	// Validate user

	if ($checkNonce and $userEdit) {
		return $post->ID;
	}

	// We'll put it into an array to make it easier to loop though.

	$Classes_Meta['_headerColor'] = $_POST['_headerColor'];
	$Classes_Meta['_trans'] = $_POST['_trans'];

	// Add values of $events_meta as custom fields

	foreach($Classes_Meta as $key => $value) {
		if ($post->post_type == 'revision') {
		}

		if (get_post_meta($post->ID, $key, FALSE)) {
			update_post_meta($post->ID, $key, $value);
		}
		else {
			add_post_meta($post->ID, $key, $value);
		}

		if (!$value) {
			delete_post_meta($post->ID, $key);
		}
	}
}

add_action('save_post', 'save_themeOption', 1, 2); // save the custom fields

// Case Study Taxonomies
function Classes_taxonomies(){
  // Tech taxonomy arguments
  $tech_args = array(
    'label' => 'Technologies Used',
    'public' => true,
    'publicaly_queryable' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'hierarchical' => true,
  );

  // Registers Taxonomy
  register_taxonomy('technologies', 'case', $tech_args);
}
Classes_taxonomies();

function enqueue_media_uploader()
{
    wp_enqueue_media();
}

add_action("admin_enqueue_scripts", "enqueue_media_uploader");

// Archive page pagination
function materialize_pagination()
{
	global $wp_query;
	$big = 999999999; // need an unlikely integer
	$pages = paginate_links(array(
		'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))) ,
		'format' => '?paged=%#%',
		'current' => max(1, get_query_var('paged')) ,
		'total' => $wp_query->max_num_pages,
		'next_text' => __('>') ,
		'prev_text' => __('<') ,
		'type' => 'array'
	));
	if (is_array($pages)) {
		$paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
		echo '<ul class="pagination">';
		foreach($pages as $page) {
			echo "<li class='waves-effect'>$page</li>";
		}

		echo '</ul>';
	}
}


// Custom Post Type Starts
// ADD CUSTOM POST TYPE: Classes
/*Custom Post type start*/

function cw_post_type_classes() {

$supports = array(
'title', // post title
'editor', // post content
'author', // post author
'thumbnail', // featured images
'excerpt', // post excerpt
'custom-fields', // custom fields
'comments', // post comments
'revisions', // post revisions
'post-formats', // post formats
'categories', // post category
);

$labels = array(
'name' => _x('Classes', 'plural'),
'singular_name' => _x('Classes', 'singular'),
'menu_name' => _x('Classes', 'admin menu'),
'name_admin_bar' => _x('Classes', 'admin bar'),
'add_new' => _x('Add New', 'add new'),
'add_new_item' => __('Add New Classes'),
'new_item' => __('New Classes'),
'edit_item' => __('Edit Classes'),
'view_item' => __('View Classes'),
'all_items' => __('All Classes'),
'search_items' => __('Search Classes'),
'taxonomies' => array('classes_type'),
'not_found' => __('No Classes found.'),
);
	


$args = array(
'supports' => $supports,
'labels' => $labels,
'public' => true,
'query_var' => true,
'rewrite' => array('slug' => 'classes'),
'has_archive' => true,
'hierarchical' => false,
);
register_post_type('Classes', $args);
}
add_action('init', 'cw_post_type_classes');

/*Custom Post type end*/


// ADD CUSTOM POST TYPE: News
/*Custom Post type start*/

function cw_post_type_news() {

$supports = array(
'title', // post title
'editor', // post content
'author', // post author
'thumbnail', // featured images
'excerpt', // post excerpt
'custom-fields', // custom fields
'comments', // post comments
'revisions', // post revisions
'post-formats', // post formats
);

$labels = array(
'name' => _x('News', 'plural'),
'singular_name' => _x('News', 'singular'),
'menu_name' => _x('News', 'admin menu'),
'name_admin_bar' => _x('News', 'admin bar'),
'add_new' => _x('Add New', 'add new'),
'add_new_item' => __('Add New News'),
'new_item' => __('New News'),
'edit_item' => __('Edit News'),
'view_item' => __('View News'),
'all_items' => __('All News'),
'search_items' => __('Search News'),
'not_found' => __('No News found.'),
);

$args = array(
'supports' => $supports,
'labels' => $labels,
'public' => true,
'query_var' => true,
'rewrite' => array('slug' => 'news'),
'has_archive' => true,
'hierarchical' => false,
);
register_post_type('News', $args);
}
add_action('init', 'cw_post_type_news');

/*Custom Post type end*/


// ADD CUSTOM POST TYPE: Events
/*Custom Post type start*/

function cw_post_type_events() {

$supports = array(
'title', // post title
'editor', // post content
'author', // post author
'thumbnail', // featured images
'excerpt', // post excerpt
'custom-fields', // custom fields
'comments', // post comments
'revisions', // post revisions
'post-formats', // post formats
);

$labels = array(
'name' => _x('Events', 'plural'),
'singular_name' => _x('Events', 'singular'),
'menu_name' => _x('Events', 'admin menu'),
'name_admin_bar' => _x('Events', 'admin bar'),
'add_new' => _x('Add New', 'add new'),
'add_new_item' => __('Add New Events'),
'new_item' => __('New Events'),
'edit_item' => __('Edit Events'),
'view_item' => __('View Events'),
'all_items' => __('All Events'),
'search_items' => __('Search Events'),
'not_found' => __('No Events found.'),
);

$args = array(
'supports' => $supports,
'labels' => $labels,
'public' => true,
'query_var' => true,
'rewrite' => array('slug' => 'events'),
'has_archive' => true,
'hierarchical' => false,
);
register_post_type('Events', $args);
}
add_action('init', 'cw_post_type_events');

/*Custom Post type end*/


// ADD CUSTOM POST TYPE: NewsLetter
/*Custom Post type start*/

function cw_post_type_newsletter() {

$supports = array(
'title', // post title
'editor', // post content
'author', // post author
'thumbnail', // featured images
'excerpt', // post excerpt
'custom-fields', // custom fields
'comments', // post comments
'revisions', // post revisions
'post-formats', // post formats
);

$labels = array(
'name' => _x('NewsLetter', 'plural'),
'singular_name' => _x('NewsLetter', 'singular'),
'menu_name' => _x('NewsLetter', 'admin menu'),
'name_admin_bar' => _x('NewsLetter', 'admin bar'),
'add_new' => _x('Add New', 'add new'),
'add_new_item' => __('Add New NewsLetter'),
'new_item' => __('New NewsLetter'),
'edit_item' => __('Edit NewsLetter'),
'view_item' => __('View NewsLetter'),
'all_items' => __('All NewsLetter'),
'search_items' => __('Search NewsLetter'),
'not_found' => __('No NewsLetter found.'),
);

$args = array(
'supports' => $supports,
'labels' => $labels,
'public' => true,
'query_var' => true,
'rewrite' => array('slug' => 'newsletter'),
'has_archive' => true,
'hierarchical' => false,
);
register_post_type('NewsLetter', $args);
}
add_action('init', 'cw_post_type_newsletter');

/*Custom Post type end*/


// Custom Post Type Ends


?>
