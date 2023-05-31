<?php
/**
 * Modal lightbox
 *
 * @package WordPress
 * @subpackage nathalie-motta theme
 */

 // Récupérer la taxonomie actuelle
 $term = get_queried_object();
 $term_id  = my_acf_load_value('ID', $term);

 $categorie  = my_acf_load_value('name', get_field('categorie-acf'));
?>
<div class="lightbox hidden" id="lightbox-<?php the_id(); ?>">
    <button class="lightbox__close">Fermer</button>
    <div class="lightbox__container">
        <button class="lightbox__next">Suivant</button>
        <button class="lightbox__prev">Précédent</button>
        <div class="lightbox__container_info flexcolumn">
            <?php the_post_thumbnail(); ?>
            <h2 class="photo-title-<?php the_id(); ?>"><?php the_id(); ?> - <?php the_title(); ?></h2>
            <div class="lightbox__info flexrow">
                <p class="photo-category-<?php the_id(); ?>"><?php echo $categorie; ?></p>
                <p class="photo-year-<?php the_id(); ?>"><?php echo the_time( 'Y' ); ?></p>
            </div>
        </div>
    </div> 
</div> 