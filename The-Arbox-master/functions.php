<?php
// functions.php

// Controle si une oeuvre doit être affichée
function getArtworks(array $artworks): array
{
    $valid_artworks = [];

    foreach ($artworks as $artwork) {
        if (array_key_exists('is_enabled', $artwork)) {
            if ($artwork['is_enabled']) {
                $valid_artworks[] = $artwork;
            }
        }
    }

    return $valid_artworks;
}
