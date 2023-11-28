<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/style.css">
        <title>The ArtBox</title>
    </head>
    <body>
        <?php require_once('variables.php'); ?>

        <!-- Header -->
        <?php require_once('header.php'); ?>

        <?php 
        // Récupération de la valeur envoyée et traitement pour retirer d'éventuelles balises HTML
        $getData = $_GET; 
        $control = false;
        $id = 0;
        $previous = 0;
        $next = 0;
        $select = 0;

        // Contrôle si on a bien reçu une donnée et qu'elle est bien numérique
        if (isset($getData['id']) && is_numeric($getData['id'])) : ?> 
            <?php foreach ($artworks as $artwork): ?>   
                <?php 
                // Contrôle si l'oeuvre exite bien 
                // si c'est le cas, on récupère les informations pour les afficher
                if ($artworks[$id]['artwork_id'] == $getData['id']): ?> 
                    <?php $select = $id;?>
                    <main>
                        <article id="detail-oeuvre">
                            <div id="img-oeuvre">
                                <img src="img/<?php echo $artworks[$id]['artwork_image']; ?>" alt="<?php echo $artworks[$id]['title']; ?>">
                            </div>
                            <div id="contenu-oeuvre">
                                <h1><?php echo $artworks[$id]['title']; ?></h1>
                                <p class="description"><?php echo $artworks[$id]['description']; ?></p>
                                <p class="description-complete">
                                    <?php echo $artworks[$id]['full_description']; ?>
                                </p>
                            </div>
                        </article>
                    </main>   
                    <!-- Affichage de l'ouevre qui est avant et celle qui est après dans la liste -->
                    <section id="container-autres-oeuvres">
                        <?php
                        if ($select > 0) {
                            $previous = $select - 1;
                        } else {
                            $previous = count($artworks) - 1;
                        }

                        if ($select < (count($artworks) - 1)) {
                            $next = $select + 1;
                        } else {
                            $next = 0;
                        }

                        ?>
                        <div class="autres-oeuvres">   
                            <h3>Oeuvre précédent</h3>
                            <a href="<?php echo 'oeuvre.php?id=' . $artworks[$previous]['artwork_id']; ?>">
                                <img src="img/<?php echo $artworks[$previous]['artwork_image']; ?>" alt="<?php echo $artworks[$previous]['title']; ?>">
                            </a>                            
                            <h4><?php echo $artworks[$previous]['title']; ?></h4>
                        </div>
                        <div class="autres-oeuvres">
                            <h3>Oeuvre suivante</h3>
                            <a href="<?php echo 'oeuvre.php?id=' . $artworks[$next]['artwork_id']; ?>">
                                <img src="img/<?php echo $artworks[$next]['artwork_image']; ?>" alt="<?php echo $artworks[$next]['title']; ?>">
                            </a>                                
                            <h4><?php echo $artworks[$next]['title']; ?></h4>
                        </div>
                        
                    </section>
                    <?php    $control = true;
                endif;               
                $id = $id + 1;                    
            endforeach;   
        endif;

        //  si l'oeuvre n'a pas été trouvé ou que la donnée récupérée n'est pas valide
        //  on affiche un message d'erreur et on retourne automatiquement à la page d'accueil au bout de 2s
        if (!$control) {
            echo '<div style="text-align: center; color: red" role="alert"><h3>L\'identifiant de l\'oeuvre est invalide.</h3></div>';
            header('Refresh:2; url=index.php');
            exit();
        } 
        ?> 
        <!-- FOOTER -->
        <?php require_once('footer.php'); ?>
    </body>
</html>
