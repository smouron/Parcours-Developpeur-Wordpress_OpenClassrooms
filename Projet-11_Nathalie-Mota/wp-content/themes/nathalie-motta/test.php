<?php 
echo(test.php);
echo('<br><hr><br>'); 
echo('Conditional Tags');
echo('<br><br>'); ?>


<?php 
echo("is front_page "); 
var_dump( is_front_page() ); 

echo("is single "); 
var_dump( is_single() ); 

echo("is page "); 
var_dump( is_page() ); 

echo("is archive "); 
var_dump( is_archive() ); 

echo("is user logged in "); 
var_dump( is_user_logged_in() );

// Conditionnal Tags pour les Custom Post Types
echo("is post type archive 'photo' "); 
var_dump( is_singular('photo') );

echo("Pour tester si vous êtes dans la page single d’un Custom Post Type"); 
var_dump( is_singular('photo') );

echo("is tax ");
var_dump( is_tax( 'photo', 'anniversaire' ) );

// Affichage de la liste des taxonomies 
$categorie_cpt = get_terms('categorie-cpt', array('hide_empty' => false)); 
foreach ( $categorie_cpt as $terms){
	echo $terms->name;
	echo('<br><br>');
	echo $terms->slug;
	echo('<br>');
}
$categorie_acf = get_terms('categorie-acf', array('hide_empty' => false)); 
foreach ( $categorie_acf as $terms){
	echo $terms->name;
	echo('<br>');
	echo $terms->slug;
	echo('<br>');
}

echo('<hr>');
$format_cpt = get_terms('format-cpt', array('hide_empty' => false)); 
foreach ( $format_cpt as $terms){
	echo $terms->name;
	echo('<br><br>');
	echo $terms->slug;
	echo('<br>');
}

// Affichage d'une taxonomie
$terms = get_terms( array(
	'taxonomy'   => 'categorie-cpt',
	'hide_empty' => false,
) );
echo("Terms: ");
print_r($terms);

// 
$term = get_queried_object();
$term_id  = my_acf_load_value('ID', $term);

$post   = get_post( $term_id );
print_r($post);
$output1 =  apply_filters( 'post-type', $post->post_content );
echo (" --- " . $output1);

$post_type = my_acf_load_value('post_type', $term);
echo ("post_type " . $post_type);
echo('<br><br>');

$post_photo = get_post($term); 
$id_photo = $post_photo->ID;
echo($id_photo);
echo('<br><br>');
$title_photo = $post_photo->post_title;
echo($title_photo);
echo('<br><br>');
$post_type_photo = $post_photo->post_type;
echo($post_type_photo);
echo('<br><br>');

// Récupération de champs personnalisé pour filter l'affichage des posts
$term = get_queried_object();
   $publication = get_queried_object_id();
   $categorie_id  =  get_post_meta( get_the_ID(), 'categorie-acf', true );
   $categorie_name  = my_acf_load_value('name', get_field('categorie-acf'));
   $format_id  =  get_post_meta( get_the_ID(), 'format-acf', true );
   $format_name = my_acf_load_value('name', get_field('format-acf'));
   // $categorie  = 'mariage';
   echo("N° publication : " . $publication . " - N° categorie: " . $categorie_id . " - Catégorie: " . $categorie_name . " - N° format: " . $format_id . " - Format: " . $format_name );
   echo('<br>');

?>

 <!-- Affichage de la liste des catégories WP -->
<ul>
	<?php wp_list_categories( array(
		'orderby' => 'name',
		'show_count' => true
	) ); ?> 
</ul>

<ul>
	<?php wp_list_categories( array(
		'exclude'  => array( 4,7 ),
		'title_li' => ''
	) ); ?>
</ul>

<ul>
	<?php wp_list_categories( array(
		'orderby'            => 'id',
		'show_count'         => true,
		'use_desc_for_title' => false,
		'child_of'           => 8
	) ); ?>
</ul>

<br>

<?php echo('<br><hr><br>'); ?>

<?php echo wp_count_posts('post')->publish; ?>

<div>
	<?php
		echo('<br><br>');
		$prev_post = get_previous_post();	
		$next_post = get_next_post();
		$post = get_post();
		echo("Precedent: ");
		echo($prev_post->ID);
		echo(" - Actuel: ");
		echo($post->ID);
		echo(" - Suivant: ");
		echo($next_post->ID);

		echo('<br><br><hr><br>');
		print_r($prev_post);
		echo('<br>');
		echo($prev_post->ID);
		echo(" - Categorie: ");
		echo get_post_meta( $prev_post->ID, 'categorie', true );
		echo(" - Format: ");	
		echo get_post_meta( $prev_post->ID, 'format', true );	

		echo('<br><br><hr><br>');
		$term = get_queried_object();
		print_r($term);	
		echo('<br>');
		echo($post->ID);	
		echo(" - Categorie: ");
		echo get_post_meta( $post->ID, 'categorie', true );	
		echo(" - Format: ");	
		echo get_post_meta( $post->ID, 'format', true );	

		echo('<br><br><hr><br>');
		print_r($next_post);
		echo('<br>');		
		echo($next_post->ID);
		echo(" - Categorie: ");
		echo get_post_meta( $next_post->ID, 'categorie', true );
		echo(" - Format: ");
		echo get_post_meta( $next_post->ID, 'format', true );
        
		echo('<br><br><hr><br>');
		$essais = get_field('categorie');
		print_r($essais);
		echo('<br><br>');	
		$essais = get_field('format');
		print_r($essais);
		echo('<br><br>');	
	?>
</div>


