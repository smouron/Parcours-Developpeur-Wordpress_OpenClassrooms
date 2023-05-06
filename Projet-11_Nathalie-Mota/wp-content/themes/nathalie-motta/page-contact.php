<?php
    get_header();
    echo ('page-contact.php');
?>

  <div id="wrap">
    <section id="content">
        <div id="loop">
            <article>
                <h1><?php the_title(); ?></h1>
                <?php
                    // On insère le formulaire de demandes de renseignements
                    echo do_shortcode('[contact-form-7 id="32" title="Formulaire de contact"]');
                ?>
            </article>
        </div>
    </section>
  </div>

<?php get_footer(); ?>

</body>
</html>