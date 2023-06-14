<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage nathalie-mota
 */
?>
	<footer id="footer">
		<?php 
			// Affichage du menu footer déclaré dans functions.php
			wp_nav_menu(array('theme_location' => 'footer')); 
		?>		
		<!-- Ajout du widget dans le pied de page -->	
		<aside id="widget-area" >
			<?php dynamic_sidebar( 'footer-widget' ); ?>
		</aside>
	</footer>

	<!-- Lance la popup contact -->
	<?php 
        get_template_part ( 'template-parts/modal/contact'); 		
    ?>

<?php wp_footer(); ?>

</body>
</html>
