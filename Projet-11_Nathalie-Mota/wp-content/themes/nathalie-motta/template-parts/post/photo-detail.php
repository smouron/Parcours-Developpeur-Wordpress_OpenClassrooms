<?php 
	// echo ('photo-detail.php');
	//   Vérifier l'activation de ACF
	if ( !function_exists('get_field')) return;

    // Récupérer la taxonomie actuelle
    $term = get_queried_object();
    $term_id  = my_acf_load_value('ID', $term);

    // Récupération du nom de la catégorie et du format
    $categorie  = my_acf_load_value('name', get_field('categorie-acf'));
    // $categorie  = my_acf_load_value('name', get_field('categorie-cpt'));

    $format = my_acf_load_value('name', get_field('format-acf'));
    // $format = my_acf_load_value('name', get_field('format-cpt'));
    $reference = get_field('reference');
    $type = get_field('type');
    $annee = get_field('annee');
    $essais = get_field('categorie-acf');
?>

<article class="container__photo flexcolumn">
    <div class="photo__info flexrow">
        <div class="photo__info--description flexcolumn">
            <h1><?php the_title(); ?></h1>
            <ul class="flexcolumn">
                <!-- Affiche les données ACF -->
                <li class="reference">Référence : 
                    <?php 
                        if($reference) {
                            echo $reference;
                        } else {
                            echo ('Inconnue');
                        }
                    ?>
                </li>
                <li>Catégorie :
                    <?php 
                        if($categorie) {
                            echo $categorie;
                        } else {
                            echo ('Inconnue');
                        }
                    ?>
                </li>
                <li>Format :             
                    <?php 
                        if($format) {
                            echo $format;
                        } else {
                            echo ('Inconnu');
                        }
                    ?>
                </li>
                <li>Type :              
                    <?php 
                        if($type) {
                            echo $type;
                        } else {
                            echo ('Inconnu');
                        }
                    ?>
                </li>
                <li>Année : 
                    <?php echo the_time( 'Y' ); ?>
                </li>
            </ul>
        </div>
        <div class="photo__info--image flexcolumn brightness">
            <!-- permet d’afficher l’image mise en avant -->
            <?php the_post_thumbnail(); ?>            
            <span class="openLightbox"></span>
        </div> 
        
    </div>
</article>

