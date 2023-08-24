<?php
/**
** activation theme
**/
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    //  Chargement des styles
    // Script JS disponnibles chargé uniquement avec front_page 
    if (is_front_page()) {
        // wp_enqueue_style( 'swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@10.0.4/swiper-bundle.min.css');
        wp_enqueue_style( 'swiper-style', get_stylesheet_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), '10.2.0' );
    }
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/assets/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/theme.css') );
    wp_enqueue_style( 'media-query-style', get_stylesheet_directory_uri() . '/assets/css/media-query.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/media-query.css') );
    wp_enqueue_style( 'animations-style', get_stylesheet_directory_uri() . '/assets/css/animations.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/animations.css') );

    // Chargement des scripts 

    // Script JS disponnibles chargé uniquement avec front_page 
    if (is_front_page()) {
        // wp_enqueue_script( 'swiper-element-bundle.min', 'https://cdn.jsdelivr.net/npm/swiper@10.0.4/swiper-bundle.min.js' );
       wp_enqueue_script( 'swiper-element-bundle.min', get_theme_file_uri( '/assets/js/swiper-bundle.js'), array(), '10.2.0', true );
    }

    // Enqueue Custom Scripts
    wp_enqueue_script( 'custom-scripts', get_theme_file_uri( '/assets/js/scripts.js' ), array('jquery'), filemtime(get_stylesheet_directory() . '/assets/js/scripts.js'), true );
}

// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );


// _____________________
// 
//  AJOUT DE SHORTCODES
// 
// _____________________

 /**
 * 
 * Shortcode pour générer un slider à partir d'articles
 * 
 * type = type d'articles que l'on souhaite avoir
 *    Les 3 types de post possible : post / formation-wordpress / exercice
 *    Par défaut on a post
 * 
 * nb = nombre de post que l'on souhaite afficher à la fois. 
 *    Par défaut on a -1 (= tous les post)
 * 
 */
function mouron_slider_post($items) {

    $items = shortcode_atts(array (
        'type' => '',
        'nb' => ''
    ), $items , 'css_separator');
    
    // Si on ne récupère aucune information pour le filtre du type d'articles
    // on concidère que l'on veut le type d'article par défaut qui est 'post'
    if ($items ['type'] == "") {
        $post_type = "post";
    } else {
        $post_type = $items ['type'];
    }
    
    // Si on ne récupère aucune information pour le nombre d'articles à la fois
    // on concidère que l'on veut la quantité d'articles par défaut qui est '-1' (= tout afficher)
    if ($items ['nb'] == "") {
        $posts_per_page = '-1';
    } else {
        $posts_per_page = $items ['nb'];
    }
    
    $string = "";

    // Initialisation de la requette Query
    $custom_args = array(
        'post_type' => $post_type,
        'posts_per_page' => $posts_per_page,
        'nopaging' => true,
    );           
    
    $query_slider = new WP_Query( $custom_args ); 

    // On récupère le nombre total d'articles qui sont trouvé avec cette requete
    $nb_total_post  = $query_slider->found_posts;
    // Mise en place du slider Swiper
    $string .= '<div class="swiper mySwiper">';
    $string .= '<div class="swiper-wrapper">';
    
    // Génération la liste des articles à afficher dans le slider
    if($query_slider->have_posts()) : ?>
        <?php while($query_slider->have_posts()) : $query_slider->the_post(); ?>
        
        <?php         
        // Initialisation des variables de chaque post   
        $term = get_queried_object();
    
        $post_id = get_the_id();
    
        // $post_name = get_the_title();
        $project_goal = get_field('project_goal');   
        $project_mission = get_field('project_mission');      

        $project_origin = get_field('project_origin');         
        
        $post_thumbnail = get_the_post_thumbnail();
        $lien_origin = "#";
        // $post_link = get_the_permalink();
                   
        $string .= '<a href="'. get_the_permalink() .'" class="swiper-slide">';
        $string .= '<h4>' . get_the_title() . '</h4>';
        $string .= get_the_post_thumbnail();
        if (!$project_origin == "") {
            $string .= '<p>Avec '. $project_origin .'</p>';
        } else {            
            $string .= '<p>Projet privé</p>';
        }
        $string .= '<p class="flexrow gap10 slider_icon">';
        
        // Recherche des techno utilisées pour afficher les icones correspondants
        $field = get_field('techno');
         if (!empty($field) && !$field == "") {
            foreach ($field as $data) {
    
                if ($data->slug == "html") { 
                    $string .= '<span class="icon_html" title="Utilisation de HTML5"><i class="fa-brands fa-html5"></i></span>'; 
                } 
                if ($data->slug == "css") { 
                    $string .= '<span class="icon_css" title="Utilisation de CSS3" ><i class="fa-brands fa-css3"></i></span>'; 
                } 
                if ($data->slug == "js" || $data->slug == "javascript") { 
                    $string .= '<span class="icon_js" title="Utilisation de JavaScript"><i class="fa-brands fa-js"></i></span>'; 
                } 
                if ($data->slug == "php") { 
                    $string .= '<span class="icon_php" title="Utilisation de PHP"><i class="fa-brands fa-php"></i></span>'; 
                } 
                if ($data->slug == "wp"  || $data->slug == "wordpress") { 
                    $string .= '<span class="icon_wp" title="Utilisation de WordPress 6" ><i class="fa-brands fa-wordpress"></i></span>'; 
                } 
                if ($data->slug == "elementor") { 
                    // $string .= '<span class="icon_elementor icon_image hidden" title="Utilisation du page builder Elementor" ><img src="'. get_stylesheet_directory_uri() . '/assets/img/Elementor-couleur-24.png" /></span>'; 
                    $string .= '<span class="icon_elementor icon_image hidden" title="Utilisation du page builder Elementor" ></span>'; 
                } 
                if ($data->slug == "gutenberg") { 
                    // $string .= '<span class="icon_gutenberg icon_image hidden" title="Utilisation du page builder Gutenber" ><img src="'. get_stylesheet_directory_uri() . '/assets/img/gutenberg-couleur-48.png" /></span>'; 
                    $string .= '<span class="icon_gutenberg icon_image hidden" title="Utilisation du page builder Gutenber" ></span>'; 
                } 
                if ($data->slug == "jquery") { 
                    // $string .= '<span class="icon_jquery hidden" title="Utilisation de jQuery" ><img src="'. get_stylesheet_directory_uri() . '/assets/img/jQuery-couleur-48.png" /></span>'; 
                    $string .= '<span class="icon_jquery hidden" title="Utilisation de jQuery" ></span>'; 
                } 
                if ($data->slug == "woocommerce" || $data->slug == "woo-commerce" ) { 
                    $string .= '<span class="icon_woo-commerce icon_image" title="Utilisation de Woo Commerce" ><img src="'. get_stylesheet_directory_uri() . '/assets/img/woocommerce-couleur-48.png" /></span>'; 
                } 
            }
        }
        
        $string .= '</p>';                    
        $string .= '</a>';  
        
        endwhile; 
    endif; 

    $string .= '</div>';
    $string .= '<div class="swiper-button-next"></div>';
    $string .= '<div class="swiper-button-prev"></div>';
    $string .= '<div class="swiper-pagination"></div>';
    $string .= '</div>';
    
    wp_reset_postdata(); 

    // Pages de test du Swiper 
    if ($items ['type'] == "tests" || $items ['type'] == "test") {
        get_template_part ( 'template-parts/post/post' , 'tests' ); 
    }

	/** On retourne le code  */
	return $string;
}

/** On publie le shortcode  */
add_shortcode('slider_post', 'mouron_slider_post');

 /**
 * 
 * Shortcode pour générer la liste des articles à afficher
 * 
 * type = type d'articles que l'on souhaite avoir
 *    Les 3 types de post possible : post / formation-wordpress / exercice
 *    Par défaut on a post
 * 
 * nb = nombre de post que l'on souhaite afficher à la fois. 
 *    Par défaut on a -1 (= tous les post)
 * 
 */
function mouron_portfolio_post($items) {

    $items = shortcode_atts(array (
        'type' => '',
        'nb' => ''
    ), $items , 'css_separator');
    
    // Si on ne récupère aucune information pour le filtre du type d'articles
    // on concidère que l'on veut le type d'article par défaut qui est 'post'
    if ($items ['type'] == "") {
        $post_type = "post";
    } else {
        $post_type = $items ['type'];
    }
    
    // Si on ne récupère aucune information pour le nombre d'articles à la fois
    // on concidère que l'on veut la quantité d'articles par défaut qui est '-1' (= tout afficher)
    if ($items ['nb'] == "") {
        $posts_per_page = '-1';
    } else {
        $posts_per_page = $items ['nb'];
    }
    
    $string = "";

    // Initialisation de la requette Query
    $custom_args = array(
        'post_type' => $post_type,
        'posts_per_page' => $posts_per_page,
        'nopaging' => true,
    );           
    
    $query_portfolio = new WP_Query( $custom_args ); 

    // On récupère le nombre total d'articles qui sont trouvé avec cette requete
    $nb_total_post  = $query_portfolio->found_posts;
    // Mise en place 
    $string .= '<div class="container_article flexrow wrap">';
    
    // Génération la liste des articles à afficher dans le slider
    if($query_portfolio->have_posts()) : ?>
        <?php while($query_portfolio->have_posts()) : $query_portfolio->the_post(); ?>
        
        <?php       
        // Initialisation des variables de chaque post   
        $term = get_queried_object();
    
        $post_id = get_the_id();
        $post_date = get_the_time('d/m/Y');
        $post_content = get_the_content();
        // $post_name = get_the_title();
        $project_goal = get_field('project_goal');   
        $project_mission = get_field('project_mission');  
        $length_mission = strlen($project_mission); 
        if ($length_mission > 150) {
            $project_mission = mb_substr($project_mission , 0, 150,'UTF-8'); 
            $project_mission .= " ...";
        }
        $project_origin = get_field('project_origin');         
        $url_github = get_field('project_github');        
        $url_website = get_field('project_link');        
        $post_thumbnail = get_the_post_thumbnail();
        
        $string .= '<div class="'. $post_type .' article_details article_'. $post_id .'">';
        $string .= '<a class="article_link" href="'. get_the_permalink() .'">';
        $string .= get_the_post_thumbnail();
        if (!$project_origin == "") {
            $string .= '<p class="origin">Avec '. $project_origin .'</p>';
        } 
        $string .= '<p class="taxonomy-techno-acf flexrow portfolio_icon">';
        
        // Recherche des techno utilisées pour afficher les icones correspondants
        $field = get_field('techno');
        if (!empty($field) && !$field == "") {
            foreach ($field as $data) {
    
                if ($data->slug == "html") { 
                    $string .= '<span class="icon_html html" title="Utilisation de HTML5"><i class="fa-brands fa-html5"></i></span>'; 
                } 
                if ($data->slug == "css") { 
                    $string .= '<span class="icon_css css" title="Utilisation de CSS3" ><i class="fa-brands fa-css3"></i></span>'; 
                } 
                if ($data->slug == "js" || $data->slug == "javascript") { 
                    $string .= '<span class="icon_js javascript" title="Utilisation de JavaScript"><i class="fa-brands fa-js"></i></span>'; 
                } 
                if ($data->slug == "php") { 
                    $string .= '<span class="icon_php php" title="Utilisation de PHP8"><i class="fa-brands fa-php"></i></span>'; 
                } 
                if ($data->slug == "wp"  || $data->slug == "wordpress") { 
                    $string .= '<span class="icon_wp wordpress" title="Utilisation de WordPress 6" ><i class="fa-brands fa-wordpress"></i></span>'; 
                }                 
                if ($data->slug == "elementor") { 
                    // $string .= '<span class="icon_elementor icon_image hidden" title="Utilisation du page builder Elementor" ><img src="'. get_stylesheet_directory_uri() . '/assets/img/Elementor-couleur-24.png" /></span>'; 
                    $string .= '<span class="icon_elementor icon_image hidden" title="Utilisation du page builder Elementor" ></span>'; 
                } 
                if ($data->slug == "gutenberg") { 
                    // $string .= '<span class="icon_gutenberg icon_image hidden" title="Utilisation du page builder Gutenber" ><img src="'. get_stylesheet_directory_uri() . '/assets/img/gutenberg-couleur-48.png" /></span>'; 
                    $string .= '<span class="icon_gutenberg icon_image hidden" title="Utilisation du page builder Gutenber" ></span>'; 
                } 
                if ($data->slug == "jquery") { 
                    // $string .= '<span class="icon_jquery hidden" title="Utilisation de jQuery" ><img src="'. get_stylesheet_directory_uri() . '/assets/img/jQuery-couleur-48.png" /></span>'; 
                    $string .= '<span class="icon_jquery hidden" title="Utilisation de jQuery" ></span>'; 
                } 
                if ($data->slug == "woocommerce" || $data->slug == "woo-commerce" ) { 
                    $string .= '<span class="icon_woo-commerce icon_image hidden" title="Utilisation de Woo Commerce" ><img src="'. get_stylesheet_directory_uri() . '/assets/img/woocommerce-couleur-48.png" /></span>'; 
                } 
            }
        }
        $string .= '</p>';   
        $string .= '<div class="container__article_info">';                 
        $string .= '<h3 class="title">' . get_the_title() . '</h3>';
        $string .= '<p>Le ' . $post_date . '</p>';
        $string .= '<h4>Objectif de cette réalisation</h4>';        
        $string .= $post_content;
        $string .= '<h4>A réaliser</h4>';        
        $string .= '<p>' . $project_mission . '</p>';        

        $string .= '<div class="btn_more flexrow">';        
        $string .= '<a class="button center article_link" href="'. get_the_permalink() .'">Lire la suite</a>';
        $string .= '</div>';
        
        $string .= '</div>';
        
        $string .= '</a>';  
        $string .= '</div>';
        
        endwhile; 
    endif; 

    $string .= '</div>';
    
    wp_reset_postdata(); 

    // Pages de test du Swiper 
    if ($items ['type'] == "tests" || $items ['type'] == "test") {
        get_template_part ( 'template-parts/post/post' , 'tests' ); 
    }

	/** On retourne le code  */
	return $string;
}

/** On publie le shortcode  */
add_shortcode('portfolio_post', 'mouron_portfolio_post');


// __________________
// 
//   FONCTIONS
// 
// __________________
  
// Recherche si les terms présents sur l'article
function techno_present () {
    foreach ($allTerm as $data) {
        // var_dump($data);
        $search = $data->slug;
        $test = my_acf_research( $search);		
        if($test>0) {
            echo($data->slug . " est présent pour cet article");
        } else {
            echo($data->slug . " n'est pas présent pour cet article !!!");
        }
    }
}

// Active ICON
function techno_icon () {
    // Récupération de la liste de tous les terms 
    $allTerm = get_terms('techno-acf');  
    $field = get_field('techno');
    
    if (!empty($field) && !$field == "") {
        foreach ($field as $data) {
            // var_dump($data);

            if ($data->slug == "html") { 
                echo('<span class="icon_html" title="Utilisation de HTML5"><i class="fa-brands fa-html5"></i></span>'); 
            } 
            if ($data->slug == "css") { 
                echo('<span class="icon_css" title="Utilisation de CSS3" ><i class="fa-brands fa-css3"></i></span>'); 
            } 
            if ($data->slug == "js" || $data->slug == "javascript") { 
                echo('<span class="icon_js" title="Utilisation de JavaScript"><i class="fa-brands fa-js"></i></span>'); 
            } 
            if ($data->slug == "php") { 
                echo('<span class="icon_php" title="Utilisation de PHP8"><i class="fa-brands fa-php"></i></span>'); 
            } 
            if ($data->slug == "wp"  || $data->slug == "wordpress") { 
                echo('<span class="icon_wp" title="Utilisation de WordPress 6" ><i class="fa-brands fa-wordpress"></i></span>'); 
            }                 
            if ($data->slug == "woo commerce"  || $data->slug == "woo-commerce") { 
                echo('<span class="icon_woo-commerce woo-commerce hidden" title="Utilisation de Woo-Commerce" ><img src="'. get_stylesheet_directory_uri() . '/assets/img/woocommerce-couleur-48.png" /></span>');  
            } 
        }
    }
}


// __________________
// 
//   AJOUT DE HOOKS
// 
// __________________

