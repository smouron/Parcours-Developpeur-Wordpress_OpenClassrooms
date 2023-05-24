console.log("Script lancé !!!");

let currentPage = 1;
const contactBtn = document.querySelectorAll(".contact");
const popupOverlay = document.querySelector(".popup-overlay");
const popupClose = document.querySelector(".popup-close");

// Récupération des variables de PHP
let categorieId = document.getElementById("categorie_id").value;
let formatId = document.getElementById("format_id").value;
let order = document.getElementById("order").value;
let orderby = document.getElementById("orderby").value;
let max_pages = document.getElementById("max_pages").value;

// Gestion de la pagination des photos
(function ($) {
  $(document).ready(function () {
    // Gestion du bouton pour voir plus de photos
    $("#load-more").click(function (e) {
      console.log(e);

      currentPage++; // Do currentPage + 1, because we want to load the next page
      console.log("max_page: " + max_pages + " - currentPage: " + currentPage);

      if (currentPage >= max_pages) {
        $("#load-more").addClass("hidden");
      }

      $.ajax({
        type: "POST",
        url: "/nathalie-motta/wp-admin/admin-ajax.php",
        dataType: "html", // <-- Change dataType from 'html' to 'json'
        data: {
          action: "weichie_load_more",
          paged: currentPage,
          categorie: categorieId,
          format: formatId,
          orderby: orderby,
          order: order,
        },
        success: function (res) {
          $(".publication-list").append(res);
        },
      });
    });

    // Gestion de la fermeture et de l'ouverture du menu
    // dans une modale pour la version mobile
    $(".btn-modal").click(function (e) {
      console.log(e);
      // $(".modal__content").animate(
      //   { height: "toggle", opacity: "toggle" },
      //   1000
      // );
      $(".modal__content").toggleClass("animate-modal");
      $(".modal__content").toggleClass("open");
      $(".btn-modal").toggleClass("close");
    });
    $("a").click(function () {
      if ($(".modal__content").hasClass("open")) {
        // $(".modal__content").animate(
        //   { height: "toggle", opacity: "toggle" },

        //   1000
        // );
        $(".modal__content").removeClass("animate-modal");
        $(".modal__content").removeClass("open");
        $(".btn-modal").removeClass("close");
      }
    });
  });
})(jQuery);

// Ouverture de la pop contact au clic sur un lien contact
contactBtn.forEach((contact) => {
  contact.addEventListener("click", () => {
    popupOverlay.classList.remove("hidden");
  });
});

// Refermeture de la pop contact au clic
popupClose.addEventListener("click", () => {
  popupOverlay.classList.add("hidden");
});
