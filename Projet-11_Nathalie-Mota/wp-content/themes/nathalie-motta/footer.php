<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage nathalie-motta
 */

?>
	<footer id="footer">
		<?php 
			// Affichage du menu footer déclaré dans functions.php
			wp_nav_menu(array('theme_location' => 'footer')); 
		?>
	</footer>

	<!-- Lance la popup contact -->
	<?php 
        get_template_part ( 'template-parts/contact'); 
    ?>

<?php wp_footer(); ?>

</body>
</html>
