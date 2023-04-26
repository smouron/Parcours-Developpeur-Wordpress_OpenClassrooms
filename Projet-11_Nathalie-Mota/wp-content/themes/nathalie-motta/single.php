<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 */

get_header();?>

	<div class="entry-content">
	<h1><?php the_title(); ?></h1>
	<p>Publié le <?php the_time('d/m/Y'); ?>
	<?php the_content();?>
	</div><!-- .entry-content -->

<?php get_footer();?>
