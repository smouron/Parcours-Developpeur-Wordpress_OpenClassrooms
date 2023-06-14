<?php
/**
 * The Home : ACCUEIL BLOG
 *
 * @package WordPress
 * @subpackage nathalie-mota theme
 */


  get_header();
?>

<!-- Bien souvent la page d'accueil du blog affiche de la même manière les informations que les pages d’archives du blog  -->
<!-- Comme ça toutes les pages d’archives du blog auront le même et unique template -->
<?php get_template_part( 'archive' ); ?>

<?php get_footer(); ?>
