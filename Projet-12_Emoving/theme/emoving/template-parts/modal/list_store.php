<?php
/**
 * Liste des magasins
 *
 */
?>                      

<?php
    $shop_name = get_the_title();
    $shop_cp = get_field('code_postal');
    $shop_town = get_field('ville');
    $shop_address = get_field('adresse');
    if (get_field('open') == "ouvert" || get_field('open') == "Ouvert") {
        $shop_open = 'open'; 
    } else {                
        $shop_open = 'close';
    }
    $shop_phone = get_field('telephone');          
    $shop_hours_week = get_field('week_schedule');    
    $shop_hours_saturday = get_field('saturday_schedule');
    $shop_hours_sunday = get_field('sunday_schedule');
?>

<div id="shop_<?php the_id(); ?>" class="store_list_information">
    <h3 class="shop_name" ><?php echo $shop_name; ?></h3>
    <p class="shop_address" ><?php echo $shop_address ?></p>
</div>    

<!-- Gestiond de la modale des informations d'un magasin -->
<div class="shop_info hidden">    
    <div class="popup-overlay">
        <div class="popup-shop">
            <div class="popup-informations">	            
                <div class="shop_info__container"> 
                    <h2>Emoving</h2>
                    <h3 class="shop_name"><?php the_title(); ?></h3>
                    <p class="shop_open ouvert">&#9864; ouvert</p>
                    
                    <p class="shop_address">Av. de Remscheid</p>
                    <p class="shop_cp">29000 Quimper</p>    
                    <button>Itinéraire</button>
                            
                    <p class="shop_phone">02 38 64 53 34</p>           
                    <p class="shop_hours shop_hours_week">Lun-Ven : 9h30/19h00</p>
                    <p class="shop_hours shop_hours_saturday">Sam : 9h30/12h00</p>
                    <p class="shop_hours shop_hours_sunday">Dim: Fermé</p>
                </div> 
            </div>	
            <button class="popup-shop__close" title="Refermer cet agrandissement">Fermer</button>
        </div>
        <!-- Gestiond de la modale des informations d'un magasin -->
    </div>  
</div>