<?php
function theme_enqueue_styles() {
    
    wp_enqueue_style( 'parent-style', get_stylesheet_directory_uri() . '/style.css' );
    
    //  Chargement du style personnalisé pour le theme
    wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/assets/css/theme.css' );        
    
    
    // Enqueue Custom Scripts
    wp_enqueue_script( 'order-custom-scripts', get_theme_file_uri( '/assets/js/scripts.js' ), array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

// créer un lien menu
// Visibles ensuite dans Apparence / Menus (after_setup_theme)
function register_my_menu(){
    register_nav_menu('main', "Menu principal");
    register_nav_menu('footer', "Menu pied de page");
 }
 add_action('after_setup_theme', 'register_my_menu');

// enregistrer des sidebars
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