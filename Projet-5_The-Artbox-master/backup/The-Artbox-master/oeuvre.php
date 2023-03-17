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
        <?php include_once ('variables.php'); ?>

        <!-- Header -->
        <?php include_once ('header.php'); ?>

        <?php 
        // Récupération de la valeur envoyée et traitement pour retirer d'éventuelles balises HTML
        $getData = $_GET; 
        $control = false;

        // Contrôle si on a bien reçu une donnée et qu'elle est bien numérique
        if (isset($getData['id']) && is_numeric($getData['id'])) {
            $dataId = htmlspecialchars(strip_tags($getData['id']));            
            $id = $getData['id'] - 1;
        } else {
            echo '<div style="text-align: center; color: red"><h3>  L\'identifiant de l\'oeuvre est invalide.</h3></div>';
            header('Refresh:2; url=index.php');
            exit();
        }

        // Contrôle si l'oeuvre exite bien 
        // si c'est le cas, on récupère les informations pour les afficher
        if (isset($artworks[$id]['artwork_id'])): ?> 
            <?php  $control = true; ?> 
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
        <?php endif; ?>     

        <!-- Contrôle si le numéro de l'oeuvre était bien présent -->
        <?php if (!$control) {
            echo '<div style="text-align: center; color: red" role="alert"><h3>L\'identifiant de l\'oeuvre est invalide.</h3></div>';
            header('Refresh:2; url=index.php');
            exit();
        }
        ?> 
        <!-- FOOTER -->
        <?php include_once ('footer.php'); ?>
    </body>
</html>
