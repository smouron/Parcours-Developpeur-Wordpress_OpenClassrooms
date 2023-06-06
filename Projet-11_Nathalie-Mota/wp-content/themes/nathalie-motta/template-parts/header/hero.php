<?php
/**
 * Hero du header
 *
 * @package WordPress
 * @subpackage nathalie-motta theme
 */
?>

<!-- Wrap Slider Area -->
<div class="hero-area">
    <div class="hero-thumbnail">
        <!-- Initialisation de post à afficher -->
        <?php   
            $custom_args = array( 
            'post_type' => 'photo',
            'orderby'   => 'rand',
            'posts_per_page' => 1,
            );
            //On crée ensuite une instance de requête WP_Query basée sur les critères placés dans la variables $args
            $query_hero = new WP_Query( $custom_args );            
        ?>
        <!-- Récupération d'un post photo en mode aléatoire (rand) -->
        <?php while($query_hero->have_posts()) : ?>
            <?php $query_hero->the_post();?> 

            <?php if(has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>"><?php the_post_thumbnail('hero'); ?></a>
            <?php endif; ?>                  
                    
        <?php endwhile; ?>            
        <h1 class="title-hero"><?php bloginfo('description'); ?></h1>
    </div>  
</div>
<?php
    // On réinitialise à la requête principale
    wp_reset_postdata();       
?>