// Gestion de l'affichage des photos supplémentaires en page d'accueil
// en fonction de la valeur des filtres

document.addEventListener("DOMContentLoaded", function () {
  // Récupération des variables de PHP

  (function ($) {
    $(document).ready(function () {
      let currentPage = 1;

      // Gestion de la pagination des photos en page d'accueil
      $("#load-more").click(function (e) {
        e.preventDefault();

        if (document.getElementById("currentPage") !== null) {
          currentPage = document.getElementById("currentPage").value;
        }
        // Récupération des valeurs des variables du filtre au moment du click
        const categorie_id = document.getElementById("categorie_id").value;
        const format_id = document.getElementById("format_id").value;
        let order = document.getElementById("date").value;
        let orderby = "date";

        let max_pages = document.getElementById("max_pages").value;

        currentPage++; // Do currentPage + 1, because we want to load the next page
        document.getElementById("currentPage").value = currentPage;

        if (currentPage >= max_pages) {
          $("#load-more").addClass("hidden");
        } else {
          $("#load-more").removeClass("hidden");
        }

        $.ajax({
          type: "POST",
          url: "/nathalie-motta/wp-admin/admin-ajax.php",
          dataType: "html", // <-- Change dataType from 'html' to 'json'
          data: {
            action: "nathalie_motta_load",
            paged: currentPage,
            categorie_id: categorie_id,
            format_id: format_id,
            orderby: orderby,
            order: order,
          },
          success: function (res) {
            $(".publication-list").append(res);
          },
        });
      });
    });
  })(jQuery);
});
