<?php 
	//   Vérifier l'activation de ACF
	if ( !function_exists('get_field')) return;
?>


<?php 
    // Récupérer la taxonomie actuelle
    $term = get_queried_object();
    $term_id  = my_acf_load_value('ID', $term);
    // Récupération du nom de la catégorie et du format
    $categorie  = my_acf_load_value('name', get_field('categorie'));
    $format = my_acf_load_value('name', get_field('format'));

?>
<section class="photo_detail">
    <div class="container__photo flexcolumn">
        <div class="photo__info flexrow">
            <div class="photo__info--description flexcolumn">
                <h1><?php the_title(); ?></h1>
                <ul class="flexcolumn">
                    <!-- Affiche les données - Méthode classique -->                    
                    <!-- <li>Référence : <?php echo get_post_meta( get_the_ID(), 'reference', true ); ?></li> -->

                    <!-- Affiche les données ACF -->
                    <li>Référence : <?php the_field('reference'); ?></li>
                    <li>Catégorie : <?php echo $categorie; ?></li>
                    <li>Format : <?php echo $format; ?></li>
                    <li>Type : <?php the_field('type'); ?></li>
                    <!-- <li>Année : <?php the_field('annee'); ?></li>     -->
                    <!-- Afficher un format de date personnalisé -->
                    <li>Année : <?php the_time( 'Y' ); ?></li>
                </ul>
            </div>
            <div class="photo__info--image flexcolumn">
                <!-- permet d’afficher l’image mise en avant -->
                <?php the_post_thumbnail(); ?>
            </div>
            <div class="photo__full hidden">                
                <?php the_post_thumbnail( 'desktop-home'); ?>
            </div>
        </div>
    </div>
    <div class="photo__contact flexrow">
        <p>Cette photo vous intéresse ? <button class="btn" type="button"><?php echo do_shortcode('[contact]'); ?></button></p>
        <div class="site__navigation flexrow">
			<div class="site__navigation__prev">
				<?php previous_post_link( '&#8606 Article Précédent<br>%link'); ?>
			</div>
			<div class="site__navigation__next">
				<?php next_post_link( 'Article Suivant &#8608<br>%link;'); ?> 
			</div>
		</div>
    </div>
    <div class="photo__others flexcolumn">
        <h2>Vous aimerez aussi</h2>
        <div class="photo__autres--images flexrow">
            <img src="http://127.0.0.1/nathalie-motta/wp-content/uploads/2023/05/nathalie-13-scaled.jpeg" alt="" >
            <img src="http://127.0.0.1/nathalie-motta/wp-content/uploads/2023/05/nathalie-5-scaled.jpeg" alt="" >
        </div>
        <button class="btn" type="button">
            <a href="http://127.0.0.1/nathalie-motta/">Toutes les photos</a>
        </button>
    </div>
</section>
