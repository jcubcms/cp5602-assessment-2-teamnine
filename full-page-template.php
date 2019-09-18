<?php
/* Template Name: full-page-template */
?>

<?php get_header(); ?>


<?php
while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
<main>
<div class="container">
<div class="content flow-text">
     <?php the_content(); ?>
 </div>	
</div>
 
<?php
endwhile;
?>
</main>
<?php get_footer(); ?>
