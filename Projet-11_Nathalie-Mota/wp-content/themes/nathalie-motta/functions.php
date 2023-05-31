<?php
// Pour les versions antérieures à WordPress 5.2
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
            do_action( 'wp_body_open' );
    }
}

function nathalie_motta_theme_enqueue() {
    //  Chargement du style personnalisé du theme
    wp_enqueue_style( 'nathalie-motta-style', get_stylesheet_uri(), array(), '1.0' );
    
	// FontAwesome Icons
	wp_enqueue_style( 'fontawesome', get_theme_file_uri( '/assets/css/fontawesome.min.css' ) );
    
    //  Chargement de style personnalisé pour le theme
    wp_enqueue_style( 'nathalie-motta-contact-style', get_stylesheet_directory_uri() . '/assets/css/contact.css', array(), '1.0' ); 
    wp_enqueue_style( 'nathalie-motta-simgle-photo-style', get_stylesheet_directory_uri() . '/assets/css/simgle-photo.css', array(), '1.0' );     
    wp_enqueue_style( 'nathalie-motta-lightbox-style', get_stylesheet_directory_uri() . '/assets/css/lightbox.css', array(), '1.0' );     
    // Chargement des script JS personnalisés
    wp_enqueue_script( 'nathalie-motta-scripts', get_theme_file_uri( '/assets/js/scripts.js' ), array('jquery'), '1.0.1', true );    
    wp_enqueue_script( 'nathalie-motta-scripts-filtres', get_theme_file_uri( '/assets/js/filtres.js' ), array(), '1.0.0', true );   
    wp_enqueue_script( 'nathalie-motta-scripts-lightbox-ajax', get_theme_file_uri( '/assets/js/lightbox-ajax.js' ), array('jquery'), '1.0.0', true );

    if (is_front_page()) {
        wp_enqueue_script( 'nathalie-motta-scripts-publication-ajax', get_theme_file_uri( '/assets/js/publication-ajax.js' ), array('jquery'), '1.0.0', true );
    };

    // activer les Dashicons sur le front-end 
    wp_enqueue_style ( 'dashicons' ); 
}
add_action( 'wp_enqueue_scripts', 'nathalie_motta_theme_enqueue' );




// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

// permet de définir la taille des images mises en avant 
// set_post_thumbnail_size(largeur, hauteur max, true = on adapte l'image aux dimensions)
set_post_thumbnail_size( 600, 0, false );

// Définir d'autres tailles d'images
add_image_size( 'hero', 1450, 960, true );
add_image_size( 'desktop-home', 600, 520, true );
add_image_size( 'mobil-home', 300, 260, true );

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );

// créer un lien pour la gestion des menus dans l'administration
// et activation d'un menu pour le header et d'un menu pour le footer
// Visibles ensuite dans Apparence / Menus (after_setup_theme)
function register_my_menu(){
    register_nav_menu('main', "Menu principal");
    register_nav_menu('footer', "Menu pied de page");
 }
 add_action('after_setup_theme', 'register_my_menu');

// créer un pour la gestion des widgets dans l'administration
// etl'activation des sidebars
// Visibles ensuite dans Apparence / Widgets (widgets_init)
function nathalie_motta_widgets(){
    register_sidebar(
        array(
            'name' => "Widget Sidebar",
            'id' => 'main-sidebar',
            'description' => "Widget pour la sidebar principale",
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>'
        )
    );
   
    register_sidebar(
        array(
            'name' => "Widget footer",
            'id' => 'footer-widget',
            'description' => "Widget pour le pied de page",
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>'
        )
    );
 }
 add_action('widgets_init', 'nathalie_motta_widgets'); 


 /**
 * Shortcode pour ajouter un bouton contact
 */
function contact_btn($string) {

	/** Code du bouton */
	$string .= '<a href="#" id="contact_btn" class="contact">Contact</a>';

	/** On retourne le code  */
	return $string;
}

/** On publie le shortcode  */
add_shortcode('contact', 'contact_btn');

// Récupération de la valeur d'un champs personnalisé ACF
// $variable = nom de la variable dont on veut récupérer la valeur
// $field = nom du champs personnalisés
function my_acf_load_value( $variable,  $field ) {
    // Initialisation de la valeur à retourner
    $return = "";
    // Recherche de la clé
    foreach($field as $key => $value) {
        if ($key === $variable) {
            $return = $value;
        }
    }
    return $return;
}


/**
* Show CPT in archives pages (TAG & Category)
*
*/
function add_custom_types_to_tax( $query ) {
    echo(is_category());
    echo(is_tag());
    if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
        // Set post type
        $post_types = array('post','page','my_cpt_1','my_cpt_2','photo');
 
        $query->set( 'post_type', $post_types );
        return $query;
    }
}
add_filter( 'pre_get_posts', 'add_custom_types_to_tax' );
  
// Partie pour gerer le padding de l'affichage des photos  
include get_template_directory() . '/includes/ajax.php';

function menu_nav() {
    $menu2 = wp_nav_menu(array('theme_location' => 'main'));
    $menu3 = wp_nav_menu(array('menu' => 'header'));
    // echo ('Menu: ' . $menu3);
}

