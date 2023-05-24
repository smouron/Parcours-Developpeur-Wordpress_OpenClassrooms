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

        if ($order === "") {
            $orderby = "title";
            $order = "ASC";
        } else {            
            $orderby = "date";
        } 
            
 
        // Initialisation du filtre d'affichage des posts
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
        // Récupérer la taxonomie actuelle
        $term = get_queried_object();
        $term_id  = my_acf_load_value('ID', $term);

        // $categorie_id  =  get_post_meta( get_the_ID(), 'categorie-acf', true );
        // $format_id  =  get_post_meta( get_the_ID(), 'format-acf', true );
        // $categorie_name  = my_acf_load_value('name', get_field('categorie-acf'));
        // $format_name = my_acf_load_value('name', get_field('format-acf'));
        $custom_args = array(
        'post_type' => 'photo',
        //   'posts_per_page' => 8,
        'posts_per_page' => get_option( 'posts_per_page'), // Valeur par défaut
        'order' => $order, // ASC ou DESC 
        'orderby' =>  $orderby, // 'date' , 'meta_value_num'
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
            $max_pages = $query->max_num_pages;
                        
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
        // wp_reset_query(); 
        wp_reset_postdata();       
        ?>
        
        <div id="pagination">
            <!-- afficher le système de pagination (s’il existe de nombreux articles) -->
            <!-- <h3>Articles suivants</h3> -->
            <?php if ($max_pages > 1): ?>
            <a href="#!" class="btn btn__primary" id="load-more">Load more</a>
            <?php endif ?>
        </div>

      </section>
        <!-- Variables pour être récupérées par JavaScript -->
        <form>
            <input type="hidden" id="categorie_id" value="<?php echo $categorie_id; ?>">
            <input type="hidden" id="format_id" value="<?php echo $format_id; ?>">
            <input type="hidden" id="orderby" value="<?php echo $orderby; ?>">
            <input type="hidden" id="order" value="<?php echo $order; ?>">
            <input type="hidden" id="max_pages" value="<?php echo $max_pages; ?>">
        </form>


      <!-- <aside id="widget-area">
      </aside> -->
  </div>
<?php get_footer(); ?>
