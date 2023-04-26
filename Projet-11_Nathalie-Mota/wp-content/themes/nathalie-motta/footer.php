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
				// Affichage du menu main déclaré dans functions.php
				wp_nav_menu(array('theme_location' => 'footer')); 
		?>
	</footer>

<?php wp_footer(); ?>

</body>
</html>
