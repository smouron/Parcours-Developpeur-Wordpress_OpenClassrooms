// Script pour gérer les filtres d'affichage en page d'accueil (front-page)
// Variables récupérées
//
// console.log("Script filtres en ajax lancé !!!");

document.addEventListener("DOMContentLoaded", function () {
  // Initialisation des variables des filtres
  let categorie_id = "";
  if (document.getElementById("categorie_id")) {
    document.getElementById("categorie_id").value = "";
  }
  let format_id = "";
  if (document.getElementById("format_id")) {
    document.getElementById("format_id").value = "";
  }
  let order = "";
  if (document.getElementById("date")) {
    document.getElementById("date").value = "";
  }

  let orderby = "date";
  if (order === "") {
    orderby = "title";
    order = "ASC";
  }

  let currentPage = 1;
  let max_pages = 1;

  (function ($) {
    $(document).ready(function () {
      $(".option-filter").change(function (e) {
        // Empêcher l'envoi classique du formulaire
        e.preventDefault();

        if (document.getElementById("max_pages") !== null) {
          max_pages = document.getElementById("max_pages").value;
        }

        // Récupération des valeurs sélectionnées
        let targetName = e.target.name;
        let targetValue = e.target.value;

        // Réaffectation de la valeur dans la variable correspondante
        if (targetName === "categorie_id") {
          categorie_id = targetValue;
        }
        if (targetName === "format_id") {
          format_id = targetValue;
        }
        if (targetName === "date") {
          order = targetValue;
        }

        if (order === "") {
          orderby = "title";
          order = "ASC";
        } else {
          orderby = "date";
        }

        // Génération du nouvel affichage
        $.ajax({
          type: "POST",
          url: "/nathalie-motta/wp-admin/admin-ajax.php",
          dataType: "html", // <-- Change dataType from 'html' to 'json'
          data: {
            action: "nathalie_motta_load",
            paged: 1,
            categorie_id: categorie_id,
            format_id: format_id,
            orderby: orderby,
            order: order,
          },
          success: function (res) {
            $(".publication-list").empty().append(res);
            // Récupération de la valeur du nouveau nombre de pages
            let max_pages = document.getElementById("max_pages").value;
            if (currentPage >= max_pages) {
              $("#load-more").addClass("hidden");
            } else {
              $("#load-more").removeClass("hidden");
            }
          },
        });
      });
    });
  })(jQuery);
});
