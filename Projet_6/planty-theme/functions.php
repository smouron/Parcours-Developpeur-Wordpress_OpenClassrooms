<?php
/**
** activation theme
**/
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
//  Chargement du style du theme parent
wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
 
//  Chargement du style personnalisé pour le theme
wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/assets/css/theme.css' );

// Enqueue Custom Scripts
wp_enqueue_script( 'order-custom-scripts', get_theme_file_uri( '/assets/js/custom-scripts.js' ), array(), '1.0.0', true );
}

// _____________________
// 
//  AJOUT DE SHORTCODES
// 
// _____________________

// SHORTCODE : création d'un bandeau de section avec une courbure
add_shortcode('css_separator', 'css_separator_func');
function css_separator_func($atts) {
    $atts = shortcode_atts(array (
        'height' => '',
        'color' => '',
        'color2' => ''
    ), $atts, 'css_separator');

    if ($atts['height'] == "") {
        $atts['height'] = '20';
    }
    
    if ($atts['color'] == "") {
        $atts['color'] = '#ECE2DA';
    }
    
    if ($atts['color2'] == "") {
        $atts['color2'] = $atts['color'];
    }

    // On commence à récupérer le flux d'information
    ob_start();
    ?>

    <div style="width: 100%; height: <?= $atts['height'] ?>px; background-color: <?= $atts['color2'] ?>; border-radius: 0 0 150% 150%; margin-bottom: 20px;"> 
        <div style="width: 100%; height: <?= $atts['height']-10 ?>px; background-color: <?= $atts['color'] ?>; border-radius: 0 0 150% 150%; margin-bottom: 20px;"></div> 
    </div> 

    <?php
    // On arrête de récupérer le flux d'information et on le stock dans la fonction $output
    $output = ob_get_contents();

    // On nettoie le flux
    ob_end_clean();

    return $output;
}


// __________________
// 
//   AJOUT DE HOOKS
// 
// __________________

/* MODIFICATION DU HEADER */

/**
 * Ajout du lien Admin dans le header quand l'opérateur est connecté
 * Si non, on ne fait rien => le menu affiché, sera celui configuré dans WP.
 */

 // Récupération de la liste des items du menu actuel (nom donné au mune dans WP : "header-menu")
add_filter( 'wp_nav_menu_header-menu_items', 'prefix_add_menu_item', 10, 2 );
function prefix_add_menu_item ( $items, $args ) {
        // Contrôle si l'utilisateur est connecté
        if (is_user_logged_in()) {
            // si l'opérateur est connecté, on initialise un tableau qui stockera la liste des items 
            $items_array = array();
            // Création d'une boucle pour récupérer la position actuel de chaque item 
            // avec '<li' comme point de repère dans la liste de items
            // l'offset de 10, permet d'être sûr de ne pas prendre en compte le '<li' où on démarre
            while ( false !== ( $item_pos = strpos ( $items, '<li', 10 ) ) ) {
                // recupère uniquement la partie qui va de <li> jusqu'au <li> suivant
                // et on le stock dans le tableau
                $items_array[] = substr($items, 0, $item_pos);
                // puis on retire cette partie de la liste des items avant de recommencer la boucle
                $items = substr($items, $item_pos);
            }
            // On ajoute au tableau le dernier élément de la liste
            $items_array[] = $items;
            // On insère le lien 'Admin' à la position indiquée (ici 1) dans le tableau.
            array_splice($items_array, 1, 0, '<li class="menu-item"><a class="menu-admin" href="'. get_site_url() .'/wp-admin/">Admin</a></li>'); // insert custom item after 9th item one
            // On retransforme le tableau en liste d'items
            $items = implode('', $items_array);
        }
       
       return $items;
    
}