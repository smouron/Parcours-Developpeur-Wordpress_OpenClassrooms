<?php
/**
 * The header
 *
 * @package WordPress
 * @subpackage nathalie-motta
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>	
	<header id="header" class="header">
		<a href="<?php echo home_url( '/' ); ?>">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo_nathalie_mota.png" 
			alt="Logo <?php echo bloginfo('name'); ?>">
		</a>
		<nav id="navigation">
			<?php 
				// Affichage du menu main déclaré dans functions.php
				wp_nav_menu(array('theme_location' => 'main')); 
			?>
		</nav>
	</header>	

