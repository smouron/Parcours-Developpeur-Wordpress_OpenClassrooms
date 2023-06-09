// Script pour la gestion de la Lightbox sur toutes les photos en dehors de la page d'accueil

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
  if (document.getElementById("total_posts") !== null) {
    total_posts = document.getElementById("total_posts").value;

    // Supression du début "Array (" et de la fin ")" pour n'avoir que les données du tableau d'origine
    total_posts = total_posts.slice(8, total_posts.length - 3);
  }

  let nb_total_posts = 1;
  if (document.getElementById("nb_total_posts") !== null) {
    nb_total_posts = document.getElementById("nb_total_posts").value;
  }

  // Intialisation des données pour le filtrage
  let regex1 = /[(]/g;
  let regex2 = /[)]/g;

  let arrayIntial = total_posts;
  let arrayFinish = new Array();
  let data = new Array();

  recupArrayPhp();

  let idPhoto = null;
  let idValue = 10;
  let arrow = "";

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
      $(".openLightbox").click(function (e) {
        e.preventDefault();

        // L'URL qui réceptionne les requêtes Ajax dans l'attribut "action" de <form>
        const ajaxurl = $(this).data("ajaxurl");

        // Récupération de la variable si on la reçoit
        // si non initialisation par défaut à true

        arrow = "true";
        if (!$(this).data("arrow")) {
          arrow = $(this).data("arrow");
        }

        if (!$(this).data("postid")) {
          console.log(
            "Identifiant manquant. Récupération du premier de la liste"
          );
          recupIdPhoto(0);
        } else {
          idPhoto = $(this).data("postid");
        }
        recupIdData(idPhoto);
        // console.log("photo n° " + idValue + " de la liste - id Photo: " +  idPhoto);

        $(".lightbox").removeClass("hidden");

        // On s'assure de le container est vide avant de charger le code
        $("#lightbox__container_content").empty();
        $.changePhoto();
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
        console.log("id: " + idValue + " - id Photo: " + idPhoto);
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
        // Récupération du jeton de sécurité
        const nonce = $("#nonce").val();

        // Récupération de l'adresse de la page	pour pointer Ajax
        const ajaxurl = $("#ajaxurl").val();

        let pathname = window.location.pathname;
        let pathnamefinal = pathname.substring(
          0,
          pathname.lastIndexOf("/photo") + 1
        );

        let url =
          window.location.protocol +
          "//" +
          window.location.host +
          pathnamefinal +
          "wp-admin/admin-ajax.php";

        // On affiche une image de chargement
        $(".lightbox__loader").removeClass("hidden");
        // On cache tout le reste en attendant le réponse
        $("#lightbox__container_content").addClass("hidden");
        $(".lightbox__next").addClass("hidden");
        $(".lightbox__prev").addClass("hidden");

        $.ajax({
          type: "POST",
          url: url,
          dataType: "html", // <-- Change dataType from 'html' to 'json'
          data: {
            action: "nathalie_motta_lightbox",
            nonce: nonce,
            photo_id: idPhoto,
          },
          success: function (res) {
            // On a eu la réponse que c'est bon donc on retire l'image de chargement
            $("#lightbox__container_content").empty().append(res);
            // On affiche les informations de la lightbox
            $(".lightbox__loader").addClass("hidden");
            $("#lightbox__container_content").removeClass("hidden");
            // On affiche les flèches que si c'était demandé
            if (arrow) {
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
