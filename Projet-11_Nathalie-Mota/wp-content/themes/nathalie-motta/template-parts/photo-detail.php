<?php 
	//   Vérifier l'activation de ACF
	if ( !function_exists('get_field')) return;

    // Récupérer la taxonomie actuelle
    $term = get_queried_object();
    $term_id  = my_acf_load_value('ID', $term);
    // Récupération du nom de la catégorie et du format
    $categorie  = my_acf_load_value('name', get_field('categorie'));
    $format = my_acf_load_value('name', get_field('format'));

?>

<div class="container__photo flexcolumn">
    <div class="photo__info flexrow">
        <div class="photo__info--description flexcolumn">
            <h1><?php the_title(); ?></h1>
            <ul class="flexcolumn">
                <!-- Affiche les données - Méthode classique -->                    
                <!-- <li>Référence : <?php echo get_post_meta( get_the_ID(), 'reference', true ); ?></li> -->

                <!-- Affiche les données ACF -->
                <li class="reference">Référence : <?php the_field('reference'); ?></li>
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
            <span class="open-lightbox"></span>
        </div>
        <div class="photo__full lightbox hidden">                
            <?php the_post_thumbnail('large'); ?>
        </div>
    </div>
</div>

