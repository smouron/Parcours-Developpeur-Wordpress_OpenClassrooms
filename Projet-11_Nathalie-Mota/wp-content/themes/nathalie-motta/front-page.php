<?php
    get_header();
    echo ('front-page.php');
?>
  <div id="wrap"> 
      <section id="content">
        <h1>Nathalie Motta</h1>
        <p>Photographe professionnelle dans l’événementiel</p>
        <?php
            if ( is_user_logged_in() ):
                $current_user = wp_get_current_user(); 
                echo "Bonjour, " . $current_user->user_firstname . " " . $current_user->user_lastname . " !";
            else:
                echo "Bonjour, visiteur !";
            endif;
        ?>
        <br><br>
        <?php   $custom_args = array(
        'post_type' => 'photo',
        // 'posts_per_page' => 1,
        // 'category_name' => $categorie, 
        'order' => 'DESC', // ASC ou DESC 
        'orderby' => 'date', // title, date, comment_count…
            );
            //On crée ensuite une instance de requête WP_Query basée sur les critères placés dans la variables $args
            $query = new WP_Query( $custom_args );
            
            echo $query->found_posts . " articles trouvés"; 
            
            ?>
            <!-- On vérifie si le résultat de la requête contient des articles -->
            <?php if($query->have_posts()) : ?>
            <div class="container-news flexrow">
            <!-- On parcourt chacun des articles résultant de la requête -->
            <?php while($query->have_posts()) : ?>
                <?php $query->the_post();?> 
                
                <?php if(has_post_thumbnail()) : ?>

                    <?php
                    // Récupérer la taxonomie actuelle
                        $term = get_queried_object();
                        $coucou = get_posts();
                        
                        // echo("Term: ");
                        // print_r($term);
                        // echo('<br><br>');
                        // echo("Coucou: ");
                        // print_r($coucou);
                        // echo('<br><br>');
                        $term_id  = my_acf_load_value('ID', $term);
                        // Récupération du nom de la catégorie et du format
                        $categorie  = my_acf_load_value('name', get_field('categorie')); 
                    ?>

                    <div class="news-info">
                        <p class="info-title"><?php the_title(); ?></p>
                        <p class="info-tax"><?php echo $categorie; ?></p>
                        <a href="<?php the_permalink() ?>">
                        <?php the_post_thumbnail(); ?>
                        <a href="<?php the_permalink() ?>" alt="<?php the_title(); ?>"><span class="detail-photo"></span></a>                            
                        <span class="open-lightbox"></span>
                    <?php endif; ?>                  
                    <br><br>
                </div>
            <?php endwhile; ?>
        </div>
        <?php else : ?>
        <p>Désolé, aucun article ne correspond à cette requête</p>  
        
        <div id="pagination">
            <!-- afficher le système de pagination (s’il existe de nombreux articles) -->
            <?php echo paginate_links(); ?>
        </div>
        
        <?php endif; 
        // On réinitialise à la requête principale
        wp_reset_query(); ?>

      </section>

      <!-- <aside id="sidebar">
      </aside> -->
  </div>

<?php get_footer(); ?>
