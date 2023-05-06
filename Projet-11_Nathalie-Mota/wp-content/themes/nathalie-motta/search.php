<?php
  // Page recherche
  get_header();
  echo ('search.php');
?>

<!-- bien souvent les résultats sont affichés de la même manière que le blog -->
<!-- Comme ça toutes les pages recherches auront le même et unique template que le blog -->
<?php get_template_part( 'archive' ); ?>

<?php get_footer(); ?>
