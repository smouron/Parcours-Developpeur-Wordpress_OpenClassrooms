<?php
/**
 * The front-page : ACCUEIL 
 *
 * @package WordPress
 * @subpackage nathalie-motta theme
 */

    get_header();
?>
  <div id="front-page"> 
      <section id="content">    
        <!-- Chargement du hero -->
        <?php get_template_part( 'template-parts/header/hero' ); ?>
        
        <!-- Chargement des filtres -->
        <?php get_template_part( 'template-parts/post/photo-filter' ); ?>
        
        
        <?php  
        // Initialisation de variable pour les filtres de requettes Query
        $categorie_id = "";
        $format_id = "";
        $order = "";
        $orderby = "date";
         
 
        // Initialisation du filtre d'affichage des posts
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        // Récupérer la taxonomie actuelle
        $term = get_queried_object();
        $term_id  = my_acf_load_value('ID', $term);

        // $categorie_id  =  get_post_meta( get_the_ID(), 'categorie-acf', true );
        // $format_id  =  get_post_meta( get_the_ID(), 'format-acf', true );
        // $categorie_name  = my_acf_load_value('name', get_field('categorie-acf'));
        // $format_name = my_acf_load_value('name', get_field('format-acf'));
        $custom_args = array(
        'post_type' => 'photo',
        // 'posts_per_page' => 8,
        'posts_per_page' => get_option( 'posts_per_page'), // Valeur par défaut
        'order' => $order, // "", ASC , DESC 
        'orderby' =>  $orderby, // 'date' , 'meta_value_num', rand
        'paged' => 1,
        'meta_query'    => array(
            'relation'      => 'AND', 
            array(
                'key'       => 'categorie-acf',
                'compare'   => 'LIKE', 
                'value'     =>  $categorie_id,
            ),
            array(
                'key'       => 'format-acf',
                'compare'   => 'LIKE',
                'value'     => $format_id,
            )
            ),
            'nopaging' => false,
            );            
            //On crée ensuite une instance de requête WP_Query basée sur les critères placés dans la variables $args
            $query = new WP_Query( $custom_args ); 
            $max_pages = $query->max_num_pages;
            
            // Création du filtre pour la lightbox pour créer un tableau 
            // avec la liste de toutes les photos correspondantes aux filtres
            $custom_args2 = array_replace($custom_args, array( 'posts_per_page' => -1, 'nopaging' => true,));
            $total_posts = get_posts( $custom_args2 );
            $nb_total_posts = count($total_posts);          
                      
            ?>
            <!-- On vérifie si le résultat de la requête contient des articles -->
            <?php if($query->have_posts()) : ?>
                <article class="publication-list container-news flexrow">
                    <!-- Mise à disposition de JS du tableau contenant toutes les données de la requette et le nombre -->
                    <form> 
                        <input type="hidden" name="total_posts" id="total_posts" value="<?php print_r( $total_posts); ?>">     
                        <input type='hidden' name='max_pages' id='max_pages' value='<?php echo $max_pages; ?>'>
                        <input type="hidden" name="nb_total_posts" id="nb_total_posts" value="<?php  echo $nb_total_posts; ?>">
                    </form> 
                    <!-- On parcourt chacun des articles résultant de la requête -->
                    <?php while($query->have_posts()) : $query->the_post();               
                            get_template_part('template-parts/post/publication');
                        endwhile; 
                    ?>
                </article>
                <div class="lightbox hidden" id="lightbox">    
                    <button class="lightbox__close" title="Refermer cet agrandissement">Fermer</button>
                    <div class="lightbox__container">
                        <div class="lightbox__loader hidden"></div>
                        <div class="lightbox__container_info flexcolumn" id="lightbox__container_info"> 
                            <div class="lightbox__container_content flexcolumn" id="lightbox__container_content"></div>   
                            <button class="lightbox__next" aria-label="Voir la photo suivante" title="Photo suivante"></button>
                            <button class="lightbox__prev" aria-label="Voir la photo précente" title="Photo précédente"></button>                     
                        </div>
                    </div> 
                </div>
            <?php else : ?>
                <p>Désolé. Aucun article ne correspond à cette demande.</p>          
            
            <?php endif; ?>
        
        <?php
        // On réinitialise à la requête principale
        // wp_reset_query(); 
        wp_reset_postdata();       
        ?>
        
        <div id="pagination">
            <!-- afficher le système de pagination (s’il existe de nombreux articles) -->
            <!-- <h3>Articles suivants</h3> -->
            <!-- Variables qui vont pourvoir être récupérées par JavaScript -->
            <form>
                <input type="hidden" name="orderby" id="orderby" value="<?php echo $orderby; ?>">
                <input type="hidden" name="order" id="order" value="<?php echo $order; ?>">
                <input type="hidden" name="posts_per_page" id="posts_per_page" value="<?php echo get_option( 'posts_per_page'); ?>">
                <input type="hidden" name="currentPage" id="currentPage" value="<?php  echo $paged; ?>">
                <input type="hidden" name="ajaxurl" id='ajaxurl' value="<?php echo admin_url( 'admin-ajax.php' ); ?>">
                <!-- c’est un jeton de sécurité, pour s’assurer que la requête provient bien de ce site, et pas d’un autre -->
                <input type="hidden" name="nonce" id='nonce' value="<?php echo wp_create_nonce( 'nathalie_motta_nonce' ); ?>" > 
                <!-- On cache le bouton s'il n'y a pas plus d'1 page -->
                <?php if ($max_pages > 1): ?>
                    <button class="btn_load-more" id="load-more">Charger plus</button>
                    <span class="camera"></span>
                <?php endif ?>
            </form>                 
        </div>
      </section>   

  </div>
<?php get_footer(); ?>
