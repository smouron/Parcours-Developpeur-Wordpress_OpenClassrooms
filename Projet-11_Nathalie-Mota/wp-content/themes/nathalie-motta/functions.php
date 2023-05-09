<?php
// Pour les versions antérieures à WordPress 5.2
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
            do_action( 'wp_body_open' );
    }
}

function theme_enqueue_styles() {
    //  Chargement du style personnalisé du theme
    wp_enqueue_style( 'nathalie-motta-style', get_stylesheet_uri(), array(), '1.0' );
    
    //  Chargement de style personnalisé pour le theme
    wp_enqueue_style( 'contact-style', get_stylesheet_directory_uri() . '/assets/css/contact.css', array(), '1.0' ); 
    wp_enqueue_style( 'simgle-photo-style', get_stylesheet_directory_uri() . '/assets/css/simgle-photo.css', array(), '1.0' );     
    
    // Chargement du script JS personnalisé
    wp_enqueue_script( 'nathalie-motta-scripts', get_theme_file_uri( '/assets/js/scripts.js' ), array('jquery'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

// permet de définir la taille des images mises en avant 
// set_post_thumbnail_size(largeur, hauteur max, true = on adapte l'image aux dimensions)
set_post_thumbnail_size( 600, 0, false );

// Définir d'autres tailles d'images
add_image_size( 'desktop-home', 600, 520, true );
add_image_size( 'mobil-home', 300, 260, true );

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );

// créer un lien menu
// Visibles ensuite dans Apparence / Menus (after_setup_theme)
function register_my_menu(){
    register_nav_menu('main', "Menu principal");
    register_nav_menu('footer', "Menu pied de page");
 }
 add_action('after_setup_theme', 'register_my_menu');

 // créer des sidebars
// Visibles ensuite dans Apparence / Widgets (widgets_init)
function register_my_sidebars(){
    register_sidebar(
        array(
            'name' => "Sidebar principale",
            'id' => 'main-sidebar',
            'description' => "La sidebar principale",
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>'
        )
    );
   
    register_sidebar(
        array(
            'name' => "Sidebar du footer",
            'id' => 'footer-sidebar',
            'description' => "La sidebar principale",
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>'
        )
    );
 }
 add_action('widgets_init', 'register_my_sidebars'); 

 /**
 * Shortcode pour ajouter un bouton contact
 */
function contact_btn($string) {

	/** Code du bouton */
	$string .= '<a href="#" id="contact_btn" class="contact-btn">Contact</a>';

	/** On retourne le code  */
	return $string;
}

/** On publie le shortcode  */
add_shortcode('contact', 'contact_btn');

// Ajout un bouton contact au menu du header
function contact_btn_navbar( $items) {	
	$items .= '
	<li class="menu-item menu-item-type-post_type menu-item-object-post">
		<a href="#" id="contact_btn_navbar" class="contact-btn">Contact</a>
	</li>';

	// On retourne le code
	return $items;
}

add_filter( 'wp_nav_menu_header-menu_items', 'contact_btn_navbar', 10, 2 );

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

// get_template_part('cpt');

