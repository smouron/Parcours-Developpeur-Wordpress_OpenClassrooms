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
    <a href="<?php the_permalink() ?>">
    <?php the_post_thumbnail(); ?>
    <a href="<?php the_permalink() ?>" alt="<?php the_title(); ?>"><span class="detail-photo"></span></a>                            
    <span class="openLightbox"></span>
</div>      
<div class="lightbox hidden">                
        <?php the_post_thumbnail('large'); ?>
</div>
<?php endif; ?> 