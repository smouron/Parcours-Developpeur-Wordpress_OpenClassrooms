// Script pour la gestion de la Lightbox sur toutes les photos uniqueùent sur la page d'acceuil

/**
 * Variables récupérées / renvoyées
 *
 * nonce : jeton de sécurité
 * ajaxurl : adresse URL de la fonction Ajax dans WP
 *
 * total_posts : tableau de toutes les données des photos correspondantes aux filtres
 * nb_total_posts : nombres de photos à afficher
 * photo_id : indentifiant de la photo à afficher
 *
 */

document.addEventListener("DOMContentLoaded", function () {
  // console.log("Script lightbox lancé !!!");

  // Récupération du tableau de toutes les photos selon les filtres
  let total_posts = "";
  let nb_total_posts = 1;
  let posts_per_page = 1;

  // Intialisation des données pour le filtrage des données dans total_post
  const regex1 = /[(]/g;
  const regex2 = /[)]/g;
  let arrayIntial;

  recupData();

  let id = "";
  let idPhoto = null;
  let idPhotoNext = null;
  let idValue = 10;
  let arrow = "true";

  function recupData() {
    if (document.getElementById("total_posts") !== null) {
      total_posts = document.getElementById("total_posts").value;

      // Supression du début "Array (" et de la fin ")" pour n'avoir que les données du tableau d'origine
      total_posts = total_posts.slice(8, total_posts.length - 3);
    }

    if (document.getElementById("nb_total_posts") !== null) {
      nb_total_posts = document.getElementById("nb_total_posts").value;
    }

    if (document.getElementById("posts_per_page") !== null) {
      posts_per_page = document.getElementById("posts_per_page").value;
    }

    arrayIntial = total_posts;
    arrayFinish = new Array();
    data = new Array();

    recupArrayPhp();
  }

  function recupArrayPhp() {
    // Récupérarion des données qui sont en texte et transfert dans un tableau javascript

    // Parcour des données pour en extraire les éléments de chaque photo
    // et les regroupper dans un seul élément commun
    for (let pas = 0; pas < nb_total_posts; pas++) {
      start = arrayIntial.search(regex1) + 2;
      end = arrayIntial.search(regex2);
      next = end + 1;

      // On extrait les informations de la photo et on les regroupe
      arrayFinish.push(arrayIntial.slice(`${start}`, `${end}`));

      // On retire ces éléments pour le filtrage suivant
      arrayIntial = arrayIntial.slice(`${next}`, -1);
    }
  }

  // Récupérération de la position de la photo dans le tableau
  function recupIdData(arg) {
    // On parcour le tableau à la recherche de l'identifiant de la photo
    for (let i = 0; i < nb_total_posts; i++) {
      data = arrayFinish[i].split("\n");
      let position = data[0].search("ID") + 7;
      if (data[0].slice(`${position}`) == arg) {
        idValue = i;
      }
    }
  }

  // Récupérération de l'identifiant de la photo en fonction de notre position dans la tableau
  function recupIdPhoto(arg) {
    data = arrayFinish[arg].split("\n");
    let position = data[0].search("ID") + 7;
    idPhoto = data[0].slice(`${position}`);
  }

  (function ($) {
    $(document).ready(function () {
      // Gestion de la pagination de la lightbox
      $(".publication-list").click(function (e) {
        e.preventDefault();

        // Récupération des élements du DOM enfants
        recupData();

        // On recherche si c'est une class detail-photo
        if (e.target.className === "detail-photo") {
          // Si on est bien sur un élément avec la class detail-photo
          // on récupère l'adresse email liée à cet élément pour ouvrir ce lien
          window.location.href = e.target.parentElement.getAttribute("href");
        }

        // Et recherche si c'est une class openLightbox
        if (e.target.className === "openLightbox") {
          // Si c'est bien un élément avec la class openLightbox
          // On récupère les élements complémentaires lié à cet élément
          if (!$(e.target).data("arrow")) {
            arrow = $(e.target).data("arrow");
          }
          if (!$(e.target).data("postid")) {
            console.log(
              "Identifiant manquant. Récupération du premier de la liste"
            );
            recupIdPhoto(0);
          } else {
            idPhoto = $(e.target).data("postid");
          }
          recupIdData(idPhoto);
          // console.log("photo n° " + idValue + " de la liste - id Photo: " +  idPhoto);

          $(".lightbox").removeClass("hidden");

          // On s'assure de le container est vide avant de charger le code
          $("#lightbox__container_content").empty();
          $.changePhoto();
        }
      });

      // Affichage de la photo prédécente
      $(".lightbox__prev").click(function (e) {
        e.preventDefault();
        idPhotoNext = idPhoto;
        console.log("Photo précédente");
        if (idValue > 0) {
          idValue--;
        } else {
          idValue = nb_total_posts - 1;
        }
        recupIdPhoto(idValue);
        console.log("id: " + idValue + " - id Photo: " + idPhoto);
        $.changePhoto();
      });

      // Affichage de la photo suivante
      $(".lightbox__next").click(function (e) {
        e.preventDefault();
        idPhotoNext = idPhoto;
        console.log("Photo suivante");
        if (idValue < nb_total_posts - 1) {
          idValue++;
        } else {
          idValue = 0;
        }
        recupIdPhoto(idValue);
        console.log("id: " + idValue + " - id Photo: " + idPhoto);
        $.changePhoto();
      });

      // Refermer la lightbox au click sur la croix
      $(".lightbox__close").click(function (e) {
        e.preventDefault();
        $.close();
      });

      /**
       * Récupération des évenments au clavier
       * @param {KeyboardEvent} e     */

      $("body").keyup(function (e) {
        e.preventDefault();
        // Refermer la lightbox en faisant echap au clavier
        if (e.key === "Escape") {
          $.close();
        }
      });

      // Affichage de la photo et des informations demandées
      $.changePhoto = function () {
        // Récupération du jeton de sécurité
        const nonce = $("#nonce").val();

        // Récupération de l'adresse de la page	pour pointer Ajax
        const ajaxurl = $("#ajaxurl").val();

        // On affiche une image de chargement
        $(".lightbox__loader").removeClass("hidden");
        // On cache tout le reste en attendant le réponse
        $("#lightbox__container_content").addClass("hidden");
        $(".lightbox__next").addClass("hidden");
        $(".lightbox__prev").addClass("hidden");

        $.ajax({
          type: "POST",
          url: ajaxurl,
          dataType: "html", // <-- Change dataType from 'html' to 'json'
          data: {
            action: "nathalie_mota_lightbox",
            nonce: nonce,
            photo_id: idPhoto,
            categorie_id: 49,
          },
          success: function (res) {
            // On a eu la réponse que c'est bon donc on retire l'image de chargement
            $("#lightbox__container_content").empty().append(res);
            // On affiche les informations de la lightbox
            $(".lightbox__loader").addClass("hidden");
            $("#lightbox__container_content").removeClass("hidden");
            // On affiche les flèches que si c'était demandé et que l'on a plus d'une photo
            if (arrow && nb_total_posts > 1) {
              $(".lightbox__next").removeClass("hidden");
              $(".lightbox__prev").removeClass("hidden");
            }
          },
        });
      };

      // On referme la lightbox au click sur la croix
      $.close = function () {
        $(".lightbox").addClass("hidden");
      };
    });
  })(jQuery);
});
