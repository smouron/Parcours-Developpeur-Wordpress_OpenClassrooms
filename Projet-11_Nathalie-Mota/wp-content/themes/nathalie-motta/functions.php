<?php
// Pour les versions antérieures à WordPress 5.2
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
            do_action( 'wp_body_open' );
    }
}

function theme_enqueue_styles() {
    //  Chargement du style personnalisé du theme
    wp_enqueue_style( 'parent-style', get_stylesheet_directory_uri() . '/style.css' );
    
    //  Chargement de style personnalisé pour le theme
    wp_enqueue_style( 'contact-style', get_stylesheet_directory_uri() . '/assets/css/contact.css' );       
    
    // Chargement du script JS personnalisé
    wp_enqueue_script( 'order-custom-scripts', get_theme_file_uri( '/assets/js/script.js' ), array('jquery'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

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
function contact_btn() {

	/** Code du bouton */
	$string .= '<a href="#" id="contact_btn" class="contact-btn">Contact</a>';

	/** On retourne le code  */
	return $string;

}
/** On publie le shortcode  */
add_shortcode('contact', 'contact_btn');

// Ajout un bouton contact au menu du header
function contact_btn_navbar( $items, $args ) {	
	$items .= '
	<li class="menu-item menu-item-type-post_type menu-item-object-post">
		<a href="#" id="contact_btn_navbar" class="contact-btn">Contact</a>
	</li>';


	// // On retourne le code
	return $items;
}

add_filter( 'wp_nav_menu_header-menu_items', 'contact_btn_navbar', 10, 2 );