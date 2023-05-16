<?php
    get_header();
    // echo ('front-page.php');

?>
  <div id="front-page"> 
      <section id="content">    
        <!-- Chargement du hero -->
        <?php get_template_part( 'template-parts/header/hero' ); ?>
        
        <!-- Chargement des filtres -->
        <?php get_template_part( 'template-parts/post/photo-filter' ); ?>
                
        <?php  
        // Récupération des paramètres de filtre dans l'url
        if (isset($_GET["categorie"])) {
            $categorie_id = $_GET["categorie"];
        } else {
            $categorie_id = "";
        }; 
        if (isset($_GET["format"])) {
            $format_id = $_GET["format"];
        } else {
            $format_id = "";
        };  
        if (isset($_GET["date"])) {
            $order = $_GET["date"];
        } else {
            $order = "";
        }; 


        // Initialisation du filtre d'affichage des posts
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

        // $categorie_id  =  get_post_meta( get_the_ID(), 'categorie-acf', true );
        $categorie_name  = my_acf_load_value('name', get_field('categorie-acf'));
        // $format_id  =  get_post_meta( get_the_ID(), 'format-acf', true );
        $format_name = my_acf_load_value('name', get_field('format-acf'));
        $custom_args = array(
        'post_type' => 'photo',
        // 'posts_per_page' => 8,
        'order' => $order, // ASC ou DESC 
        'orderby' => 'date', // 'date' , 'meta_value_num'
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
        // 'nopaging' => false,
            );
            //On crée ensuite une instance de requête WP_Query basée sur les critères placés dans la variables $args
            $query = new WP_Query( $custom_args );
            
            // echo $query->found_posts . " articles trouvés"; 
                        
            ?>
            <!-- On vérifie si le résultat de la requête contient des articles -->
            <?php if($query->have_posts()) : ?>
                <article class="publication-list container-news flexrow">
                    <!-- On parcourt chacun des articles résultant de la requête -->
                    <?php while($query->have_posts()) : $query->the_post();                    
                            get_template_part('template-parts/post/publication');
                        endwhile; 
                    ?>
                </article>
            <?php else : ?>
                <p>Désolé. Aucun article ne correspond à cette requête.</p>          
            
            <?php endif; ?>
        
        <?php
        // On réinitialise à la requête principale
        wp_reset_query(); 
        // wp_reset_postdata();       
        ?>
        
        <div id="pagination">
            <!-- afficher le système de pagination (s’il existe de nombreux articles) -->
            <!-- <h3>Articles suivants</h3> -->
            <!-- <a href="#!" class="btn btn__primary" id="load-more">Load more</a> -->
            <?php 
                // echo paginate_links();
            ?>
        </div>

      </section>

      <!-- <aside id="sidebar">
      </aside> -->
  </div>

<?php get_footer(); ?>
