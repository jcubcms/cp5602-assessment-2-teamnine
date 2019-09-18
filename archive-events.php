<?php
/**
 * Template Name: Events
 */

get_header(); ?>

<main>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php
			$args = array(
				'post_type'      => 'events',
				'posts_per_page' => - 1,
			);
			$q    = new WP_Query( $args );
		?>

		<div class="row">
			<?php while ( $q->have_posts() ) : $q->the_post(); ?>
				<div class="col s4">
 <div class="card">
      <div class="card-image waves-effect waves-block waves-light">
        <a href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail( 'full', array( 'class' => 'responsive-img') ); ?>
        </a>
      </div>
      <div class="card-content">
        <div class="card-title">
          <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
        </div>
        <div>
          <small><?php the_time('F jS, Y'); ?> by <?php the_author_posts_link(); ?></small>
          <small class="postmetadata"><?php _e( 'Posted in' ); ?> <?php the_category( ', ' ); ?></small>
        </div>
        <div><?php the_excerpt(); ?></div>
        <div>
          <a class="waves-effect waves-light btn blogBtn" href="<?php the_permalink(); ?>">Read More</a>
        </div>
      </div>
      </div>	
				</div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>

	<?php endwhile; ?>
</main>

<?php get_footer();