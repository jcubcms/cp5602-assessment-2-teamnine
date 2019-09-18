<?php get_header(); ?>
<?php while ( have_posts() ) : the_post();?>
	<div class="bngs-singleImage valign-wrapper center" style="background-image:url('<?php the_post_thumbnail_url(); ?>');">
		<div class="container bngs-singleMeta">
			<h1 class="bngs-title"><?php the_title(); ?></h1>
		</div>
		<div class="overlay"></div>
	</div>
	<?php

	$images = get_field('casestudy_images');

	if( $images ): ?>
	    <ul>
	        <?php foreach( $images as $image ): ?>
	            <li>
	                <a href="<?php echo $image['url']; ?>">
	                     <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
	                </a>
	                <p><?php echo $image['caption']; ?></p>
	            </li>
	        <?php endforeach; ?>
	    </ul>
	<?php endif; ?>
<?php endwhile; ?>
<?php get_footer(); ?>
