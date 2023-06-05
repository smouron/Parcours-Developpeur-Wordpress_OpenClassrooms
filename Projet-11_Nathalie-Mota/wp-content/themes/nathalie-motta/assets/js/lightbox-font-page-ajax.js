// Script pour la gestion de la Lightbox sur toutes les photos

document.addEventListener("DOMContentLoaded", function () {
  console.log("Script lightbox lancé !!!");

  // Récupération du tableau de toutes les photos selon les filtres
  let total_posts = "";
  if (document.getElementById("total_posts") !== null) {
    total_posts = document.getElementById("total_posts").value;

    // Supression du début "Array (" et de la fin ")" pour n'avoir que les données du tableau d'origine
    total_posts = total_posts.slice(8, total_posts.length - 3);
    // console.log(total_posts);
  }

  let nb_total_posts = 1;
  if (document.getElementById("nb_total_posts") !== null) {
    nb_total_posts = document.getElementById("nb_total_posts").value;
  }

  let posts_per_page = 1;
  if (document.getElementById("posts_per_page") !== null) {
    posts_per_page = document.getElementById("posts_per_page").value;
  }

  // Intialisation des données pour le filtrage
  let regex1 = /[(]/g;
  let regex2 = /[)]/g;

  let arrayIntial = total_posts;
  let arrayFinish = new Array();
  let data = new Array();

  recupArrayPhp();

  let id = "";
  let idPhoto = null;
  let idPhotoNext = null;
  let idValue = 10;
  let arrow = "true";

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

    console.log("Id Photo: " + idPhoto);
  }

  (function ($) {
    $(document).ready(function () {
      // Gestion de la pagination de la lightbox
      $(".publication-list").click(function (e) {
        e.preventDefault();
        // Récupération des élements du DOM enfants
        // console.log(e.currentTarget);
        // console.log(e.target.className);

        // On recherche si c'est une class detail-photo
        if (e.target.className === "detail-photo") {
          // Si on est bien sur un élément avec la class
          // on récupère l'adresse email lié à cet élément pour ouvrir ce lien
          // console.log(e.target.parentElement);
          window.location.href = e.target.parentElement.getAttribute("href");
        }

        // Et recherche si c'est une class openLightbox
        if (e.target.className === "openLightbox") {
          // Si c'est bien un élément avec la class openLightbox
          // On récupère les élements complémentaires lier à cet élément
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
          console.log(
            "Photo n° " + idValue + " de la liste - id Photo: " + idPhoto
          );

          $(".lightbox").removeClass("hidden");

          // On s'assure de le container est vide avant de chager le code
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
        console.log("id: " + idValue + " - Arrow: " + arrow);
        recupIdPhoto(idValue);
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
        console.log("id: " + idValue + " - Arrow: " + arrow);
        recupIdPhoto(idValue);
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
        // On affiche une image de chargement
        $(".lightbox__loader").removeClass("hidden");
        // On cache tout le reste en attendant le réponse
        $("#lightbox__container_content").addClass("hidden");
        $(".lightbox__next").addClass("hidden");
        $(".lightbox__prev").addClass("hidden");

        $.ajax({
          type: "POST",
          url: "/nathalie-motta/wp-admin/admin-ajax.php",
          dataType: "html", // <-- Change dataType from 'html' to 'json'
          data: {
            action: "nathalie_motta_lightbox",
            photo_id: idPhoto,
          },
          success: function (res) {
            // On a eu la réponse que c'est bon
            // On retire l'image de chargement
            $("#lightbox__container_content").empty().append(res);
            // On affiche les informations de la lightbox
            $(".lightbox__loader").addClass("hidden");
            $("#lightbox__container_content").removeClass("hidden");
            // On affiche les flèches que si c'était demandé
            if (arrow) {
              // Si on veut les fleches, on les affiche
              $(".lightbox__next").removeClass("hidden");
              $(".lightbox__prev").removeClass("hidden");
            }
          },
        });
      };

      $.close = function () {
        $(".lightbox").addClass("hidden");
      };
    });
  })(jQuery);
});
