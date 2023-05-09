<?php 
	// var_dump( is_singular('photo') );

   // [post_type] => post
   // [post_type] => photo
   // On place les critères de la requête dans un Array
   $term = get_queried_object();
   $coucou = get_posts();
   
   echo("Term: ");
   print_r($term);
   echo('<br><br>');
   echo("Coucou: ");
   print_r($coucou);
   echo('<br><br>');
   
   echo(" ----- ");
   // $categorie  = my_acf_load_value('name', get_field('categorie'));
   $categorie  = 'mariage';
   // $post_photo = get_post($term); 
   // $id_photo = $post_photo->ID;
   // echo($id_photo);
   // $title_photo = $post_photo->post_title;
   // echo($title_photo);
   // $post_type_photo = $post_photo->post_type;
   // echo($post_type_photo);
   $custom_args = array(
      'post_type' => 'photo',
      'posts_per_page' => 1,
      // 'category' => 'Catégorie',
      'category_name' => $categorie, 
      'order' => 'DESC', // ASC ou DESC 
      'orderby' => 'date', // title, date, comment_count…
   );
   //On crée ensuite une instance de requête WP_Query basée sur les critères placés dans la variables $args
   $query = new WP_Query( $custom_args );
   
   echo("Query: ");
   print_r($query);
  echo('<br><br>');
  echo $query->found_posts . " articles trouvés"; 
  
?>
 <!-- On vérifie si le résultat de la requête contient des articles -->
  <?php if($query->have_posts()) : ?>
   <div class="container">
   <p>Catégorie: <?php echo($categorie);?></p>
   <br><br>
<!-- On parcourt chacun des articles résultant de la requête -->
       <?php while($query->have_posts()) : ?>
           <?php $query->the_post();?> 
           
           <div class="news">
               <h2><?php the_title(); ?></h2>
               
               <?php if(has_post_thumbnail()) : ?>
                    <div class="thumbnail">
                       <?php the_post_thumbnail(); ?>
                     </div>
               <?php endif; ?>
               <a href="<?php the_permalink() ?>"><?php the_permalink() ?></a>
               <br><br>
           </div>
       <?php endwhile; ?>
   </div>
<?php else : ?>
   <p>Désolé, aucun article ne correspond à cette requête</p>  
<?php endif; 
   // On réinitialise à la requête principale
  wp_reset_query();
?>


