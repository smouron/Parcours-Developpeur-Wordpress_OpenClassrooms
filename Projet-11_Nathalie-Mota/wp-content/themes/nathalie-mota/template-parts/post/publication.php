<?php
/**
 * Modal publication
 *
 * @package WordPress
 * @subpackage nathalie-mota theme
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
    <p class="info-tax"><?php echo $categorie; ?></p>
    <a href="<?php the_permalink() ?>" aria-label="Voir le détail de la photo <?php the_title(); ?>" alt="<?php the_title(); ?>" title="Voir le détail de la photo"><span class="detail-photo"></span></a>                            
    <?php the_post_thumbnail(); ?>
    <p><?php the_terms( $post->ID, 'categorie-acf', '' ); ?></p>
    <form>
        <input type="hidden" name="postid" class="postid" value="<?php the_id(); ?>">
                       
        <a class="openLightbox" title="Afficher la photo en plein écran" alt="Afficher la photo en plein écran"
            data-postid="<?php echo get_the_id(); ?>"    
            data-arrow="true" 
        >
        </a>
    </form>
</div> 

<?php endif; ?> 
