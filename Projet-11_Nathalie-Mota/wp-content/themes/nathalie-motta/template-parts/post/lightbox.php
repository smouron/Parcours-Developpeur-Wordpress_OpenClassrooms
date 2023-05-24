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
<div class="lightbox hidden">
    <button class="lightbox__close">Fermer</button>
    <div class="lightbox__container">
        <button class="lightbox__next">Suivant</button>
        <button class="lightbox__prev">Précédent</button>
        <div class="lightbox__container_info flexcolumn">
            <?php the_post_thumbnail(); ?>
            <h2><?php the_title(); ?></h2>
            <div class="lightbox__info flexrow">
                <p><?php echo $categorie; ?></p>
                <p><?php echo the_time( 'Y' ); ?></p>
            </div>
        </div>
    </div> 
</div> 