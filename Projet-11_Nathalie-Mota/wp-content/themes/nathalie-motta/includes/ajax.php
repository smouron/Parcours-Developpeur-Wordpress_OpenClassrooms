<?php
// WordPress a donc défini lui même quels étaient les paramètres de sa WP Query
// pour connaitre la valeur de ces paramètres
function capitaine_override_query( $wp_query ) {
    echo('query_vars: ');
    var_dump( $wp_query->query_vars );
    echo('<br><br>');

    echo('tax_query: ');
    var_dump( $wp_query->tax_query );
    echo('<br><br>');

    echo('meta_query: ');
    var_dump( $wp_query->meta_query );
    echo('<br><br>');
  }
// add_action( 'pre_get_posts', 'capitaine_override_query' );

// Génération de l'affichage de la suite des photos
function nathalie_motta_load_more() { 
  // Récupération des données pour le filtre
  $categorie_id = $_POST['categorie'];
  $format_id = $_POST['format'];
  $orderby = $_POST['orderby'];
  $order = $_POST['order'];
  $paged = $_POST['paged'];

  // Configuration du filtre
    $query = new WP_Query([
      'post_type' => 'photo',
        // 'posts_per_page' => 8,
      'posts_per_page' => get_option( 'posts_per_page'), // Valeur par défaut
      'orderby' => $orderby,
      'order' => $order,
      'paged' => $paged, 
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
    ]);
     
    $response = '';
  
    if($query->have_posts()) {
      while($query->have_posts()) : $query->the_post();
        $response .= get_template_part('template-parts/post/publication');
      endwhile;
    } else {
      $response = '';
    
    }

    exit;
  }
  add_action('wp_ajax_weichie_load_more', 'nathalie_motta_load_more');
  add_action('wp_ajax_nopriv_weichie_load_more', 'nathalie_motta_load_more');

?>