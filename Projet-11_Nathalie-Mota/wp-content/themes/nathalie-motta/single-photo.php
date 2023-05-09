<!-- Article de photo -->
<?php
	get_header();
	echo ('single-photo.php');
?>

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
	<section class="photo_detail">
		<?php get_template_part ( 'template-parts/photo-detail'); ?>
		
		<div class="photo__contact flexrow">
			<p>Cette photo vous intéresse ? <button class="btn" type="button"><?php echo do_shortcode('[contact]'); ?></button></p>
			<div class="site__navigation flexrow">				
				<div class="site__navigation__prev">
					<!-- <?php previous_post_link( '%link', '%title', false ); ?> -->
					<!-- <br>>&#8606 -->
					<?php
						$prev_post = get_previous_post();							
						if($prev_post) {
							$prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
							$prev_post_id = $prev_post->ID;
							echo '<a rel="prev" href="' . get_permalink($prev_post_id) . '" title="' . $prev_title. '" class="previous_post">';
							if (has_post_thumbnail($prev_post_id)){
							?>
								<div><?php echo get_the_post_thumbnail($prev_post_id, array(60,60));?></div>
							<?php
							}
							else{
								echo '<img src="'. get_stylesheet_directory_uri() .'/assets/img/no-image.jpeg" alt="Pas de photo" width="60px" ><br>';
							}
							
							echo '<img src="'. get_stylesheet_directory_uri() .'/assets/img/precedent.png" alt="Photo précédente" ></a>';
						}
					?>
				</div>
				<div class="site__navigation__next">
					<!-- <?php next_post_link( '%link', '%title', false ); ?>  -->
					<!-- <br>&#8608 -->
					<?php
						$next_post = get_next_post();
						if($next_post) {
							$next_title = strip_tags(str_replace('"', '', $next_post->post_title));
							$next_post_id = $next_post->ID;
							echo  '<a rel="next" href="' . get_permalink($next_post_id) . '" title="' . $next_title. '" class="next_post">';
							if (has_post_thumbnail($next_post_id)){
							?>
								<div><?php echo get_the_post_thumbnail($next_post_id, array(60,60));?></div>
							<?php
							}
							else{
								echo '<img src="'. get_stylesheet_directory_uri() .'/assets/img/no-image.jpeg" alt="Pas de photo" width="60px" ><br>';
							}							
							echo '<img src="'. get_stylesheet_directory_uri() .'/assets/img/suivant.png" alt="Photo suivante" ></a>';
						}
					?>
				</div>
			</div>
		</div>
		<div class="photo__others flexcolumn">
			<h2>Vous aimerez aussi</h2>		
			<div class="photo__others--images flexrow">
				<?php 
				// get_template_part ( 'template-parts/photo-common');
				 ?>
				<!-- <img src="http://127.0.0.1/nathalie-motta/wp-content/uploads/2023/05/nathalie-13-scaled.jpeg" alt="" > -->
				<!-- <img src="http://127.0.0.1/nathalie-motta/wp-content/uploads/2023/05/nathalie-5-scaled.jpeg" alt="" > -->
			</div>
			<button class="btn" type="button">
				<a href="http://127.0.0.1/nathalie-motta/">Toutes les photos</a>
			</button>
		</div>
	</section>
<?php endwhile; endif; ?>

<?php get_footer();?>

				<?php 
				get_template_part ( 'template-parts/photo-common');
				 ?>
