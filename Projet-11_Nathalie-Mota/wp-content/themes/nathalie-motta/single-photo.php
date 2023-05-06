<!-- Article de photo -->
<?php
	get_header();
	echo ('single-photo.php');
?>

<!-- <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?> -->
	<?php get_template_part ( 'template-parts/photo-detail'); ?>
<!-- <?php endwhile; endif; ?> -->

<?php get_footer();?>
