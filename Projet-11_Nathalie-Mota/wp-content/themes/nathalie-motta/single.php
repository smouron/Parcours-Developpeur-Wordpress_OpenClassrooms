<?php
/**
 * The single : ATRICLE BLOG 
 *
 * @package WordPress
 * @subpackage nathalie-motta theme
 */

	get_header();
?>

<div id="wrap">
    <section id="content">
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			
		<article class="post">
			<?php 
				// permet d’afficher l’image mise en avant
				the_post_thumbnail(); 
			?>

			<h1><?php the_title(); ?></h1>

			<div class="post__meta">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?>
				<p>
				Publié le <?php the_date(); ?>
				par <?php the_author(); ?>
				Dans la catégorie <?php the_category(); ?>
				Avec les étiquettes <?php the_tags(); ?>
				</p>
			</div>

			<div class="post__content">
				<?php the_content(); ?>
			</div>
		</article>
		<?php endwhile; endif; ?>

		<p>Navigation</p>
		<div class="site__navigation flexrow">
			<div class="site__navigation__prev">
				<?php previous_post_link( 'Article Précédent<br>%link' ); ?>
			</div>
			<div class="site__navigation__next">
				<?php next_post_link( 'Article Suivant<br>%link' ); ?> 
			</div>
		</div>
    </section>
</div>
<br>
<?php get_footer();?>

