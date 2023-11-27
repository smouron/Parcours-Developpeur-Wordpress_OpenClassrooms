<?php
// Initialisation du texte à retourner
// Initialisation de la requette Query
$custom_args = array(
'post_type' => 'dev-wd',
'posts_per_page' => -1,
'nopaging' => true,
);           

$query_slider = new WP_Query( $custom_args ); 

$nb_total_post  = $query_slider->found_posts;

echo('test swiper - Projets : ' . $nb_total_post . " post(s)");
?>

<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <?php if($query_slider->have_posts()) : ?>
            <?php while($query_slider->have_posts()) : $query_slider->the_post(); ?>
                <?php  
                // Initialisation des vraiables ce chaque post   
                $term = get_queried_object();

                $post_id = get_the_id();

                $post_name = get_the_title();
                $project_goal = get_field('project_goal');   
                $project_mission = get_field('project_mission');   
                $exercises_origin = get_field('exercises_origin'); 
                            // if ($exercises_origin == "") {
                            //     $exercises_origin = "Open Classrooms";
                            // };
                            
                $post_thumbnail = get_the_post_thumbnail();

                $post_language = array("html", "css");
                if (get_field('project_language')) {
                    $post_language = get_field('project_language');
                }
                if (get_field('langage_class')) {
                    $post_language = get_field('langage_class');
                }                
                if (get_field('langage_perso')) {
                    $post_language = get_field('langage_perso');
                }
                ?>
                <a href="#" class="swiper-slide flexcolumn">
                    <h4><?php echo $post_name; ?></h4>
                    <!-- <img src="http://127.0.0.1/WordPress/wp-content/themes/test/assets/images/computer-chic-dressing.png" / alt="Slide 1"> -->
                    <div class="<?php echo $post_type; ?> image-post" title="<?php echo $post_id; ?>  - <?php echo $post_name; ?>"><?php echo $post_thumbnail; ?></div >
                    <!-- Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <p class="flexrow gap10">
                    <?php
                        for($x = 0; $x < count($post_language); $x++){ 
                            if ($post_language[$x] == "html") { 
                                echo('<span class="icone_html" title="Utilisation de HTML5"><i class="fa-brands fa-html5"></i></span>');
                            } else if ($post_language[$x] == "css") { 
                                echo('<span class="icone_css" title="Utilisation de CSS3" ><i class="fa-brands fa-css3"></i></span>');
                            } else if ($post_language[$x] == "js") { 
                                echo('<span class="icone_js" title="Utilisation de JavaScript"><i class="fa-brands fa-js"></i></span>');
                            } else if ($post_language[$x] == "php") { 
                                echo('<span class="icone_php" title="Utilisation de PHP8"><i class="fa-brands fa-php"></i></span>');
                            } else if ($post_language[$x] == "wp") { 
                                echo('<span class="icone_wp" title="Utilisation de WordPress 6" ><i class="fa-brands fa-wordpress"></i></span>');
                            } else  {
                                echo('<span>'. $post_language[$x] .'</span>');
                            }
                        }  
                    ?>
                    </p>
                </a>            
            <?php endwhile; ?>                         
        
        <?php endif; ?>  
        <!-- <div class="swiper-button-next"></div> -->
        <!-- <div class="swiper-button-prev"></div> -->
    </div>
    <div class="swiper-pagination"></div>
</div>

<?php wp_reset_postdata(); ?>