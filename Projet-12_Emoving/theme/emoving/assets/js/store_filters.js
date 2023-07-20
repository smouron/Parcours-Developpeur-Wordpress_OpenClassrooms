document.addEventListener("DOMContentLoaded", function () {
  console.log("store_filters.js lancé !!!");
  let valueFilter = "";
  let shop_cp = "";
  let shop_town = "";
  let count = 0;
  // Chargement de la pop magasin
  (function ($) {
    // Contrôle que JQuery est bien lancé et que la page est bien affichée
    $(document).ready(function () {
      console.log("query store_filters.js lancé !!!");
      $("input").change(function (e) {
        // Empêcher l'envoi classique du formulaire
        e.preventDefault();
        console.log("Change search !!!");
        valueFilter = e.target.value;
        $.controlInput(valueFilter);

        $.infoShop();
      });

      $.controlInput = function () {
        count = (valueFilter.match(/\,/g) || []).length + 1;
        console.log("Il y a " + count + " mot(s)");
        let ligneValue = "";
        let value = valueFilter;
        for (let index = count; index > 0; index--) {
          if (index > 1) {
            ligneValue = value.substring(0, value.indexOf(","));
          } else {
            ligneValue = value;
          }
          if ($.isNumeric(ligneValue) && ligneValue.length < 6) {
            shop_cp = ligneValue.replace(/ /g, "");
            console.log("C'est un code postal: " + shop_cp);
          }

          if (!$.isNumeric(ligneValue)) {
            if ($.isNumeric(ligneValue.substring(0, 6))) {
              shop_cp = ligneValue.substring(0, 6).replace(/ /g, "");
              shop_town = ligneValue.substring(6);
              console.log("C'est une ville avec le code postal");
            } else {
              console.log("C'est une ville");
              shop_town = ligneValue;
            }
          }

          value = value.slice(ligneValue.length + 1);
        }
      };

      $.infoShop = function () {
        // Récupération du jeton de sécurité
        const nonce = $("#nonce").val();

        // Récupération de l'adresse de la page	pour pointer Ajax
        const ajaxurl = $("#ajaxurl").val();
        // console.log(nonce);
        // console.log(ajaxurl);

        // Génération du nouvel affichage
        console.log("Création de la requête Ajax pour la liste des magasins");
        $(".leaflet-shadow-pane").empty();
        $(".leaflet-marker-pane").empty();

        $.ajax({
          type: "POST",
          url: ajaxurl,
          dataType: "html", // <-- Change dataType from 'html' to 'json'
          data: {
            action: "emoving_store_list",
            nonce: nonce,
            shop_cp: shop_cp,
            shop_town: shop_town,
          },
          success: function (res) {
            console.log("Récupération de la réponse de la requête Ajax");
            $(".store_list").empty().append(res);
          },
        });

        console.log("Création de la requête Ajax pour la carte des magasins");
        $.ajax({
          type: "POST",
          url: ajaxurl,
          dataType: "html", // <-- Change dataType from 'html' to 'json'
          data: {
            action: "emoving_store_map",
            nonce: nonce,
            shop_cp: shop_cp,
            shop_town: shop_town,
          },
          success: function (res) {
            console.log("Récupération de la réponse de la requête Ajax");
            $(".leaflet-marker-pane").append(res);
          },
        });

        shop_cp = "";
        shop_town = "";
      };
    });
  })(jQuery);
});
