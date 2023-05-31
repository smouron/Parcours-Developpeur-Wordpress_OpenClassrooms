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
  $paged = intval($_POST['paged']);

  // Configuration du filtre
    $query_more = new WP_Query([
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
  
    if($query_more->have_posts()) {
      while($query_more->have_posts()) : $query_more->the_post();
        $response .= get_template_part('template-parts/post/publication');
      endwhile;
    } else {
      $response = '';
    
    }

    exit;
  }
  add_action('wp_ajax_nathalie_motta_load_more', 'nathalie_motta_load_more');
  add_action('wp_ajax_nopriv_nathalie_motta_load_more', 'nathalie_motta_load_more');



// Génération de l'affichage de la lightbox
function nathalie_motta_lightbox() {

  // On vérifie que l'identifiant a bien été envoyé
  if( ! isset( $_POST['photo_id'] ) ) {
    wp_send_json_error( "L'identifiant de la photo est manquant.", 403 );
  }

  // Récupération des données pour le filtre
  $photo_id = intval($_POST['photo_id']);

  // Configuration du filtre
  $query_lightbox = new WP_Query([
    'post_type' => 'photo',
    'posts_per_page' => -1,
  ]);
 
$response = '';

if($query_lightbox->have_posts()) {
  while($query_lightbox->have_posts()) : $query_lightbox->the_post();
  if ( get_the_id() == $photo_id) {
    $response = get_template_part('template-parts/modal/lightbox');
  }
  endwhile;
} else {
  $response = '';

}

exit;
 }
add_action('wp_ajax_nathalie_motta_lightbox', 'nathalie_motta_lightbox');
add_action('wp_ajax_nopriv_nathalie_motta_lightbox', 'nathalie_motta_lightbox');

?>
 

