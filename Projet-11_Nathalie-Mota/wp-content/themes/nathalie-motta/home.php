<?php
  // page d’accueil du blog
  get_header();
  echo ('home.php');
?>

<!-- Bien souvent la page d'accueil du blog affiche de la même manière les informations que les pages d’archives du blog  -->
<!-- Comme ça toutes les pages d’archives du blog auront le même et unique template -->
<?php get_template_part( 'archive' ); ?>

<?php get_footer(); ?>
