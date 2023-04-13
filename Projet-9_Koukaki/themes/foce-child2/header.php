<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fleurs_d\'oranger_&_Chats_errants
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'foce' ); ?></a>

	<header id="masthead" class="site-header">
        <nav id="site-navigation" class="main-navigation">
            <ul>
                <li class="site-title "><a href="#" rel="home">Fleurs d'oranger & chats errants</a></li>
            </ul>

            <div id="modal" class="modal" aria-controls="primary-menu" aria-expanded="false">
                <button class="modal__burger modal-open">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </button>
                <div class="modal__content">
                    <img class="modal__content--logo" src="<?php echo get_theme_file_uri() . '/assets/images/logo.png'; ?>" alt="">
                    <ul>
                        <li class="modal__content--story flower cat"><a href="#story">Histoire</a></li>
                        <li class="modal__content--characters flower cat"><a href="#characters">Personnages</a></li>
                        <li class="modal__content--place flower cat"><a href="#place">Lieu</a></li>
                        <li class="modal__content--studio flower cat"><a href="#studio">Studio Koukaki</a>
                        </li>
                    </ul>

                    <div class="modal__content--footer modal-trigger flower cat">
                        <a href="#">STUDIO KOUKAKI</a></li>
                    </div>

                </div>
            </div>

        </nav><!-- #site-navigation -->
	</header><!-- #masthead -->
