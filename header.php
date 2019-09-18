<!DOCTYPE html>
<html>
  <head>
    <title><?php wp_title(); ?><?php bloginfo('name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" />
    <!-- Importing Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Wordpress Script Enqueue Location -->
    <?php wp_head(); ?>

    <!-- Theme Main Stylesheet -->
	  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" type="text/css" />

  </head>
  <body>
    <?php
    $postid = get_the_ID();
    $headerTransparency = get_post_meta( $postid ,'_trans', true);
    $headerColor = get_post_meta( $postid ,'_headerColor', true);
    if (is_archive() || is_home()){
      $headerTransparency = 'off';
      $headerColor = 'dark';
    }
    if($headerTransparency != 'on'){
      $showme = 'off';
      $solid = 'solid';
      $headerColor = 'dark';
    }
    elseif($headerTransparency == 'on'){
      $showme = 'on';
      $headerColor = get_post_meta( $postid ,'_headerColor', true);
    }
    ?>
    <!-- Navigation -->
    <div class="navbar-fixed transparency <?php echo $headerColor; ?> <?php echo $solid; ?>">
      
		
<nav>
  <div class="nav-wrapper">
    <a href="/" class="brand-logo">
		<div class="nav-wrapper">		
			<?php $custom_logo_id = get_theme_mod( 'custom_logo' );
   				$image = wp_get_attachment_image_src( $custom_logo_id , 'full' ); ?>
				<img src="<?php echo $image[0]; ?>" alt="">
	  </a>
	  
    <ul class="right hide-on-med-and-down">
      <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'right hide-on-med-and-down')); ?>
    </ul>
	<ul id="nav-mobile" class="sidenav show-on-med-and-down hide-on-med-and-up">
        <li><a href="#">Navbar Link</a></li>
     </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger show-on-med-and-down hide-on-med-and-up"><i class="material-icons">menu</i></a>
		
	<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
</div>
</nav>
        
		
		
    </div>
    <div class="<?php echo $showme; ?>"></div>
	  <div class="row"></div>
	  <div class="row"></div>
	  <div class="row"></div>
