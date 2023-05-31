<?php
/**
 * Modal publication
 *
 * @package WordPress
 * @subpackage nathalie-motta theme
 */
?>

<?php if(has_post_thumbnail()) : ?>                        

<?php
    // Récupérer la taxonomie ACF actuelle
    $term = get_queried_object();                                              
    $term_id  = my_acf_load_value('ID', $term);
    // Récupération du nom de la catégorie 
    $categorie  = my_acf_load_value('name', get_field('categorie-acf')); 
?>

<!-- Génération du nombre de photo en fonction de l'option dans WordPress -->
<div class="news-info brightness">
    <h2 class="info-title"><?php the_title(); ?></h2>
    <h3 class="info-tax"><?php echo $categorie; ?></h3>
    <!-- <p class="info-tax"><?php the_terms( $post->ID, 'categorie-acf', '' ); ?></p> -->
    <a href="<?php the_permalink() ?>" alt="<?php the_title(); ?>"><span class="detail-photo"></span></a>                            
    <?php the_post_thumbnail(); ?>
    <p><?php the_terms( $post->ID, 'categorie-acf', '' ); ?></p>
    <form>
        <input type="hidden" name="postid" class="postid" value="<?php the_id(); ?>">
        <button class="openLightbox"
            data-postid="<?php echo get_the_id(); ?>"    
            data-arrow="true" 
            data-nonce="<?php echo wp_create_nonce('nathalie_motta_lightbox'); ?>"
            data-action="nathalie_motta_lightbox"
            data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>"
        >
        </button>
    </form>
</div> 

<?php endif; ?> 