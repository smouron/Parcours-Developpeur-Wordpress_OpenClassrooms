<?php
/**
 * The single : ATRICLE BLOG 
 *
 * @package WordPress
 * @subpackage nathalie-mota theme
 */

	get_header();
?>

<div>
	<div class="container__info__post">
		<p>PAGE</p>
		<h1>
			<?php echo(get_the_title()); ?>		
		</h1>	
		<div class="image__post w100 flexrow center">
		<?php
		$image1 = get_field('image_sup_1');
		$slider = get_field('project_slider');
		if (!empty($slider) && !$slider =="") {
			echo($slider);	
		} else if (!empty($image1) && !$image1 =="") {
			echo('<img src="'. $image1 .'" alt="'. get_the_title() .'" title="'. get_the_title() .'">');
		} else {
			echo(get_the_post_thumbnail()); 
		}
		?>	
		</div>	
		<h2>Les objectifs du projet</h2>
		<p><?php echo(get_field('project_goal')); ?></p>
		<h2>Détail du projet à effectuer</h2>
		<?php echo(get_field('project_mission')); ?>			
		<h2>Je que j'ai fait</h2>
		<?php echo(get_field('technical_choice')); ?>	
	</div>

	<!-- Affichage de post précéent et du suivant -->
	<div class="container__site__navigation flexrow center">
		<div class="site__navigation__prev">
			<?php
			$prev_post = get_previous_post();							
			if($prev_post) {
				$prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
				$prev_post_id = $prev_post->ID;
				echo '<a rel="prev" href="' . get_permalink($prev_post_id) . '" title="' . $prev_title. '" class="previous_post">';
				if (has_post_thumbnail($prev_post_id)){
					?>
					<div>
						<?php echo get_the_post_thumbnail($prev_post_id, array(300,240));?>
					</div>
					<?php
					} else {
						echo '<img src="'. get_stylesheet_directory_uri() .'/assets/img/no-image.jpeg" alt="Pas de photo" width="300px" ><br>';
					}							
				echo '<img src="'. get_stylesheet_directory_uri() .'/assets/img/precedent.png" alt="Précédent" ></a>';
			}
			?>
			</div>
			<div class="site__navigation__next">
				<!-- next_post_link( '%link', '%title', false );  -->
				<?php
				$next_post = get_next_post();
				if($next_post) {
					$next_title = strip_tags(str_replace('"', '', $next_post->post_title));
					$next_post_id = $next_post->ID;
					echo  '<a rel="next" href="' . get_permalink($next_post_id) . '" title="' . $next_title. '" class="next_post">';
					if (has_post_thumbnail($next_post_id)){
						?>
						<div>
							<?php echo get_the_post_thumbnail($next_post_id, array(300,240));?>
						</div>
						<?php
						} else{
							echo '<img src="'. get_stylesheet_directory_uri() .'/assets/img/no-image.jpeg" alt="Pas de photo" width="300px" ><br>';
						}							
					echo '<img src="'. get_stylesheet_directory_uri() .'/assets/img/suivant.png" alt="Suivant" ></a>';
				}
				?>
					
			</div>
		</div>
	</div>
</div>

<?php get_footer();?>
		
		