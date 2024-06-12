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
    <body class="d-flex flex-column min-vh-100">

        <!-- Header -->
        <?php require_once('header.php'); ?>

        <main>
            <div id="list-artwork">
                <?php foreach ($artworks as $artwork): ?> 
                    <article class="artwork">
                        <a href="<?php echo 'oeuvre.php?id=' . $artwork['artwork_id']; ?>">
                            <img src="img/<?php echo $artwork['artwork_image']; ?>" alt="<?php echo $artwork['title']; ?>">
                            <h2><?php echo $artwork['title']; ?></h2>
                            <p class="description"><?php echo $artwork['description']; ?></p>
                        </a>
                    </article>    
                <?php endforeach; ?>     
            </div>
        </main>
        
        <!-- FOOTER -->
        <?php require_once('footer.php'); ?>
    </body>
</html>