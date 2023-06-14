// Gestion de l'affichage des photos supplémentaires en page d'accueil
// en fonction de la valeur des filtres

/**
 * Variables récupérées / renvoyées
 *
 * nonce : jeton de sécurité
 * ajaxurl : adresse URL de la fonction Ajax dans WP
 *
 * categorie_id : n° de la catégorie demandée ou vide si on ne filtre pas par catégorie
 * format_id : n° du format demandé ou vide si on ne filtre pas par format
 * order : ordre de tri Croissant (ASC) ou Décroissant (DEC)
 * orderby : actuellement on trie par la date mais on pourrait éventuellement avoir un autre critère
 * posts_per_page : nombre de photos à afficher en même temps
 * currentPage : page affichée au moment de l'utilisation du script
 * max_pages : page maximum en fonction des filtres
 *
 */

document.addEventListener("DOMContentLoaded", function () {
  // Récupération des variables de PHP

  (function ($) {
    $(document).ready(function () {
      let currentPage = 1;

      // Gestion de la pagination des photos en page d'accueil
      $("#load-more").click(function (e) {
        e.preventDefault();

        // L'URL qui réceptionne les requêtes Ajax dans l'attribut "action" de <form>
        // Récupération du jeton de sécurité
        const nonce = $("#nonce").val();

        // Récupération de l'adresse de la page	pour pointer Ajax
        const ajaxurl = $("#ajaxurl").val();

        if (document.getElementById("currentPage") !== null) {
          currentPage = document.getElementById("currentPage").value;
        }
        // Récupération des valeurs des variables du filtre au moment du click
        const categorie_id = document.getElementById("categorie_id").value;
        const format_id = document.getElementById("format_id").value;
        let order = document.getElementById("date").value;
        let orderby = "date";

        let max_pages = document.getElementById("max_pages").value;

        // currentPage + 1, pour pouvoir charger la page suivante
        currentPage++;
        document.getElementById("currentPage").value = currentPage;

        if (currentPage >= max_pages) {
          $("#load-more").addClass("hidden");
        } else {
          $("#load-more").removeClass("hidden");
        }

        $.ajax({
          type: "POST",
          url: ajaxurl,
          dataType: "html", // <-- Change dataType from 'html' to 'json'
          data: {
            action: "nathalie_mota_load",
            nonce: nonce,
            paged: currentPage,
            categorie_id: categorie_id,
            format_id: format_id,
            orderby: orderby,
            order: order,
          },

          success: function (res) {
            $(".publication-list").append(res);

            // Mise à jour du n° de page affiché
            document.getElementById("currentPage").value = currentPage;
          },
        });
      });
    });
  })(jQuery);
});
