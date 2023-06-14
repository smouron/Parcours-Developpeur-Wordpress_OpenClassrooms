// Script pour gérer les filtres d'affichage en page d'accueil (front-page)
//
console.log("Script filtres en ajax lancé !!!");

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
 * currentPage : page affichée au moment de l'utilisation du script
 * max_pages : page maximum en fonction des filtres
 * nb_total_posts : nombres de photos à afficher
 *
 */

document.addEventListener("DOMContentLoaded", function () {
  const body = document.querySelector("body");
  const allDashicons = document.querySelectorAll(".dashicons");
  const allSelect = document.querySelectorAll("select");
  const message = "<p>Désolé. Aucun article ne correspond à cette demande.<p>";

  // Initialisation des variables des filtres au premier affichage du site
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

  let currentPage = 1;
  let max_pages = 1;
  let selectId = "";

  document.getElementById("currentPage").value = 1;

  // Gestion du déplacement des filtres horizontalement
  const swiper = new Swiper(".swiper-container", {
    freeMode: true,
    grabCursor: true,
    breakpoints: {
      1200: {
        grabCursor: false,
        allowTouchMove: false,
      },
    },
  });

  (function ($) {
    $(document).ready(function () {
      $(".option-filter").change(function (e) {
        // Empêcher l'envoi classique du formulaire
        e.preventDefault();

        // Récupération du jeton de sécurité
        const nonce = $("#nonce").val();

        // Récupération de l'adresse de la page	pour pointer Ajax
        const ajaxurl = $("#ajaxurl").val();

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

        let orderby = "date";

        // Génération du nouvel affichage
        $.ajax({
          type: "POST",
          url: ajaxurl,
          dataType: "html", // <-- Change dataType from 'html' to 'json'
          data: {
            action: "nathalie_mota_load",
            nonce: nonce,
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
            let nb_total_posts = 0;

            // Affiche ou cache le bouton "Charger plus" en fonction du nombre de pages
            if (currentPage >= max_pages) {
              $("#load-more").addClass("hidden");
            } else {
              $("#load-more").removeClass("hidden");
            }

            // Contrôle s'il y a des photos à afficher
            if (document.getElementById("nb_total_posts") !== null) {
              nb_total_posts = document.getElementById("nb_total_posts").value;
            }

            // Et affiche un message s'il n'y a aucune photo à afficher
            if (nb_total_posts == 0) {
              $(".publication-list").append(message);
            }

            // Réinitialisation du n° de page affiché
            document.getElementById("currentPage").value = 1;
          },
        });
      });
    });
  })(jQuery);

  // Réinitialisation des flèches des select si on click en dehors
  body.addEventListener("click", (e) => {
    if (e.target.tagName != "select" && e.target.tagName != "SELECT") {
      initArrow();
    }
  });

  // Fonction pour rechercher un mot dans une variable
  // retourne vrai si le mot est trouvé, si non retourne false
  function findWord(word, str) {
    return RegExp("\\b" + word + "\\b").test(str);
  }

  // Réinitialisation de l'affichage des flèches sur les select
  const initArrow = () => {
    console.log("Initialisation des fleches");
    allDashicons.forEach((dashicons) => {
      dashicons.classList.add("select-close");
      dashicons.classList.remove("select-open");
    });
  };

  // Passer de la flèche qui descend à la flèqhe qui monte
  // et inversement
  // et force la flèche qui descend sur les 2 autres selects
  const arrow = (arg) => {
    allDashicons.forEach((dashicons) => {
      if (findWord(arg, dashicons.className)) {
        if (
          findWord("select-close", dashicons.className) ||
          findWord("select-open", dashicons.className)
        ) {
          // initArrow();
          if (findWord("select-close", dashicons.className)) {
            dashicons.classList.remove("select-close");
            dashicons.classList.add("select-open");
          } else {
            dashicons.classList.add("select-close");
            dashicons.classList.remove("select-open");
          }
        }
      }
    });
  };

  // Détection du click sur un select
  // et modification de la flèche correpondante
  allSelect.forEach((select) => {
    select.addEventListener("click", (e) => {
      e.preventDefault();

      // On contrôle si on a clické dans un autre select
      if (select.id != selectId) {
        initArrow();
      }
      selectId = select.id;
      arrow(selectId);
    });
  });
});
