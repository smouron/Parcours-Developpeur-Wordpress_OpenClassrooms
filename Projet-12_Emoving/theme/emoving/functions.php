<?php
/**
** activation theme
**/
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
//  Chargement de font-awesome
// wp_enqueue_style( 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', '6.4.0' );

//  Chargement du style du theme parent
wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
 
//  Chargement du style personnalisé pour le theme
wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/assets/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/theme.css') );

// Enqueue Custom Scripts
wp_enqueue_script( 'custom-scripts', get_theme_file_uri( '/assets/js/scripts.js' ), array('jquery'), filemtime(get_stylesheet_directory() . '/assets/js/scripts.js'), true );
wp_enqueue_script( 'store-information-scripts', get_theme_file_uri( '/assets/js/store_information.js' ), array('jquery'), filemtime(get_stylesheet_directory() . '/assets/js/store_information.js'), true );
wp_enqueue_script( 'store-filters-scripts', get_theme_file_uri( '/assets/js/store_filters.js' ), array('jquery'), filemtime(get_stylesheet_directory() . '/assets/js/store_filters.js'), true );

// leaflet
// wp_enqueue_style( 'leaflet-style', get_stylesheet_directory_uri() . '/assets/css/leaflet.css', array(), "1.9.4", true  );
// wp_enqueue_script( 'leaflet-scripts', get_theme_file_uri( '/assets/js/leaflet.js' ), array(), '1.9.4', true );
// wp_enqueue_script( 'leaflet-src-esm-scripts', get_theme_file_uri( '/assets/js/leaflet-src.esm.js' ), array(), '1.9.4', true );
// wp_enqueue_script( 'leaflet-src-scripts', get_theme_file_uri( '/assets/js/leaflet-src.js' ), array(), '1.9.4', true );


}

// _____________________
// 
//  AJOUT DE SHORTCODES
// 
// _____________________

// SHORTCODE : Affichage de la liste des magasins
function wp_store_list() {
    // Initialisation des variables
    if (isset($_POST['shop_cp'])) {         
        $cp = intval($_POST['shop_cp']);
    } else {
        $cp = "";
    }

    if (isset($_POST['shop_town'])) {
        $town = $_POST['shop_town'];
    } else {
        $town = "";
    }

    $output = "";
    $shop_name = "";
    $shop_cp = "";
    $shop_town = "";
    $shop_address = "";
    // $shop_open = "close";
    // $shop_phone = "00.00.00.00.00";
    // $shop_hours_week = "Fermé";    
    // $shop_hours_saturday = "Fermé";
    // $shop_hours_sunday = "Fermé";
    $shop_latitude = "";
    $shop_longitude = "";
    $shop_id = 0;
    
    // Initialisation de la requette Query
    $custom_args = array(
        'post_type' => 'magasin',
        'posts_per_page' => -1,
        'meta_query'    => array(
            'relation'      => 'AND', 
            array(
                'key'       => 'code_postal',
                'compare'   => 'LIKE', 
                'value'     =>  $cp,
            ),
            array(
                'key'       => 'ville',
                'compare'   => 'LIKE',
                'value'     => $town,
            )
          ),
        'nopaging' => true,
    );           

    $query = new WP_Query( $custom_args ); 

    // On commence à récupérer le flux d'information
	ob_start();
    ?>

    <div class="store_list"> 
        <!-- On vérifie si le résultat de la requête contient des articles -->
        <?php if($query->have_posts()) : ?>

            <?php while($query->have_posts()) : $query->the_post(); ?>

            <?php 
                // Pour chaque magasin, récupération des informations le concernant
                // $term = get_queried_object();

                $output = "";
                $shop_name = get_the_title();
                $shop_cp = get_field('code_postal');
                $shop_town = get_field('ville');
                $shop_address = get_field('adresse');
                if (get_field('open') == "ouvert" || get_field('open') == "Ouvert") {
                    $shop_open = 'open'; 
                } else {                
                    $shop_open = 'close';
                }
                $shop_phone = get_field('telephone');          
                $shop_hours_week = get_field('week_schedule');    
                $shop_hours_saturday = get_field('saturday_schedule');
                $shop_hours_sunday = get_field('sunday_schedule');
                $shop_latitude = get_field('latitude');
                $shop_longitude = get_field('longitude');
                $shop_id = 0;
                ?>
                <div id="shop_<?php the_id(); ?>" class="store_list_information">
                    <h3 class="shop_name" ><?php echo $shop_name; ?></h3>
                    <p class="shop_address" ><?php echo $shop_address ?></p>
                </div>    

                <!-- Gestiond de la modale des informations d'un magasin -->
                <div class="shop_info shop_info_<?php the_id(); ?> hidden">    
                    <div class="popup-overlay">
                        <div class="popup-shop">
                            <div class="popup-informations">	            
                                <div class="shop_info__container"> 
                                    <h2>Emoving</h2>
                                    <h3 class="shop_name"><?php echo $shop_name; ?></h3>
                                    <p class="shop_open ouvert">&#9864;<?php echo $shop_open; ?></p>
                                    
                                    <p class="shop_address"><?php echo $shop_address; ?></p>
                                    <p class="shop_cp"><?php echo $shop_cp; ?> <?php echo $shop_town; ?></p>    
                                    <button>Itinéraire</button>
                                            
                                    <p class="shop_phone"><?php echo $shop_phone; ?></p>           
                                    <p class="shop_hours shop_hours_week">Lun-Ven : <?php echo $shop_hours_week; ?></p>
                                    <p class="shop_hours shop_hours_saturday">Sam : <?php echo $shop_hours_saturday; ?></p>
                                    <p class="shop_hours shop_hours_sunday">Dim: <?php echo $shop_hours_sunday; ?></p>
                                </div> 
                            </div>	
                            <button class="popup-shop__close" title="Refermer cet agrandissement">Fermer</button>
                        </div>
                        <!-- Gestiond de la modale des informations d'un magasin -->
                    </div>  
                </div>   
          
            <?php endwhile; ?>
            
            <?php else : ?>
                <p>Aucun magasin ne correspond à cette demande.</p>          
        
        <?php endif; ?>
    </div> 
    <?php
    // On arrête de récupérer le flux d'information et on le stock dans la fonction $output
    $output = ob_get_contents();

    // On nettoie le flux
    ob_end_clean();

    return $output;
}

/** On publie le shortcode  */
add_shortcode('store_list', 'wp_store_list');

// SHORTCODE : Génération de la carte avec les prepères sur la carte par magasins
function wp_store_map() {
    // Initialisation des variables     
    $output = "";
    $shop_name = "";
    $shop_cp = "00000";
    $shop_town = "";
    $shop_latitude = "";
    $shop_longitude = "";
    $shop_id = 0;
    
    // Initialisation de la requette Query
    $custom_args = array(
        'post_type' => 'magasin',
        'posts_per_page' => -1,
        'nopaging' => true,
    );           

    $query = new WP_Query( $custom_args ); 

    $nb_total_shop  = $query->found_posts;

    // On commence à récupérer le flux d'information
	ob_start();
    ?>
    <!-- On vérifie si le résultat de la requête contient des articles -->
    <?php if($query->have_posts()) : ?>
        <?php 
            $index = 0; 
            $list_shop = [];    
        ?>

        
        <?php echo do_shortcode('[leaflet-map !dragging !keyboard !scrollwheel zoom=6 lat=46.8399602 lng=2.213749]'); ?>

        <?php while($query->have_posts()) : $query->the_post(); ?>
            <?php 
                // Pour chaque magasin, récupération des informations le concernant
                $term = get_queried_object();

                $shop_id = get_the_id();

                $output = "";
                $shop_name = get_the_title();
                $shop_cp = get_field('code_postal');
                $shop_town = get_field('ville');
                $shop_address = get_field('adresse');
                $shop_latitude = get_field('latitude');
                $shop_longitude = get_field('longitude');
                $index ++;
                $list_shop += array(
                    $index => get_the_id(),
                );

                $markerIcone = get_theme_file_uri( '/assets/images/marker-icon-2.png' );
                
                echo do_shortcode('[leaflet-marker iconUrl='.$markerIcone.' alt="Marker_'.$shop_id.'" title="Emoving '.$shop_name.'" lat='.$shop_latitude.' lng='.$shop_longitude.'][/leaflet-marker]');
            ?>        
            
        <?php endwhile; ?>
        
        <?php else : ?>
            <p>Il n'y a aucun magasin.</p>          
    
    <?php endif;  ?>
    <form>  
        <!-- Mise à disposition de JS du tableau contenant toutes les données de la requette et le nombre -->                 
        <input type="hidden" name="map_list_shop" id="map_list_shop" value="<?php print_r( $list_shop); ?>">         
        <input type="hidden" name="total_shop" id="total_shop" value="<?php  echo ($nb_total_shop); ?>">  
        <input type="hidden" name="ajaxurl" id='ajaxurl' value="<?php echo admin_url( 'admin-ajax.php' ); ?>">
        <input type="hidden" name="nonce" id='nonce' value="<?php echo wp_create_nonce( 'emoving_nonce' ); ?>" > 
        <!-- Mise à jour par ajax.php -->                                    
    </form>  

    <?php

    // On arrête de récupérer le flux d'information et on le stock dans la fonction $output
    $output = ob_get_contents();

    // On nettoie le flux
    ob_end_clean();

    return $output;
}

/** On publie le shortcode  */
add_shortcode('store_map', 'wp_store_map');

function wp_store_search() {
 // On commence à récupérer le flux d'information
 ob_start();
 ?>
    <form class="store_search_form relative" method="" >
        <input type="text" id="store_search" placeholder="ville, cp, ..." value="" > 
        <span class="absolute"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></span>
    </form>
 <?php 

 // On arrête de récupérer le flux d'information et on le stock dans la fonction $output
 $output = ob_get_contents();

 // On nettoie le flux
 ob_end_clean();

 return $output;
}
add_shortcode('store_search', 'wp_store_search');

// __________________
// 
//   FONCTIONS
// 
// __________________
  
// Mise à jour de la liste des magasins
function emoving_store_list() {
    if( 
          ! isset( $_REQUEST['nonce'] ) or 
             ! wp_verify_nonce( $_REQUEST['nonce'], 'emoving_nonce' ) 
      ) {
          wp_send_json_error( "Vous n’avez pas l’autorisation d’effectuer cette action.", 403 );
        exit;
        }

    // echo'<script>console.log("CP "+'.$_POST['shop_cp'].');</script>';   
    echo do_shortcode('[store_list]');
    $response = '';  
   
  wp_reset_postdata();
  exit;
   }

  add_action('wp_ajax_emoving_store_list', 'emoving_store_list');
  add_action('wp_ajax_nopriv_emoving_store_list', 'emoving_store_list');

  // Mise à jour de la carte des magasins
  function emoving_store_map() {
    if( 
          ! isset( $_REQUEST['nonce'] ) or 
             ! wp_verify_nonce( $_REQUEST['nonce'], 'emoving_nonce' ) 
      ) {
          wp_send_json_error( "Vous n’avez pas l’autorisation d’effectuer cette action.", 403 );
        exit;
        }
    
    // Initialisation des variables
    if (isset($_POST['shop_cp'])) {         
        $cp = intval($_POST['shop_cp']);
    } else {
        $cp = "";
    }

    if (isset($_POST['shop_town'])) {
        $town = $_POST['shop_town'];
    } else {
        $town = "";
    }

    // Initialisation de la requette Query
    $custom_args = array(
        'post_type' => 'magasin',
        'posts_per_page' => -1,
        'meta_query'    => array(
            'relation'      => 'AND', 
            array(
                'key'       => 'code_postal',
                'compare'   => 'LIKE', 
                'value'     =>  $cp,
            ),
            array(
                'key'       => 'ville',
                'compare'   => 'LIKE',
                'value'     => $town,
            )
          ),
        'nopaging' => true,
    );           

    $query_majmap = new WP_Query( $custom_args ); 
         


    if($query_majmap->have_posts()) : ?>
        <?php 
            $index = 0; 
            $list_shop = [];    
        ?>

        <?php while($query_majmap->have_posts()) : $query_majmap->the_post(); ?>
            <?php 
                // Pour chaque magasin, récupération des informations le concernant
                $term = get_queried_object();

                $shop_id = get_the_id();

                $shop_name = get_the_title();
                $shop_cp = get_field('code_postal');
                $shop_town = get_field('ville');
                $shop_address = get_field('adresse');
                $shop_latitude = get_field('latitude');
                $shop_longitude = get_field('longitude');
                $index ++;
                $list_shop += array(
                    $index => get_the_id(),
                );

                $markerIcone = get_theme_file_uri( '/assets/images/marker-icon-green.png' );            
                    
                echo do_shortcode('[leaflet-marker iconUrl='.$markerIcone.' alt="Marker_'.$shop_id.'" title="Emoving '.$shop_name.'" lat='.$shop_latitude.' lng='.$shop_longitude.'][/leaflet-marker]');
                // echo do_shortcode('[leaflet-marker title='.$index.' lat='.$shop_latitude.' lng='.$shop_longitude.'][/leaflet-marker]');
                ?>        
                
            <?php endwhile; ?>      
                   
        
        <?php endif; 

    $response = '';  
   
  wp_reset_postdata();
  exit;
   }

  add_action('wp_ajax_emoving_store_map', 'emoving_store_map');
  add_action('wp_ajax_nopriv_emoving_store_map', 'emoving_store_map');
// __________________
// 
//   AJOUT DE HOOKS
// 
// __________________

