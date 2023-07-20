document.addEventListener("DOMContentLoaded", function () {
  console.log("store_information.js lancé !!!");

  // const storeList = document.querySelectorAll(".store_list");
  const shopInfo = document.querySelector(".shop_info");
  // const shopInfoClose = document.querySelector(".shop_info__close");
  // const popupShopClose = document.querySelectorAll(".popup-shop__close");

  // const body = document.querySelector("body");
  let shopId = 0;

  // Récupération du nombre de magasins sur la carte
  let totalShop = 0;
  if (document.getElementById("total_shop") !== null) {
    totalShop = document.getElementById("total_shop").value - 1;
  }

  // Récupération la liste des magasins sur la carte
  let data = "";
  let listShop = new Array();

  if (document.getElementById("map_list_shop") !== null) {
    data = document.getElementById("map_list_shop").value;

    // Supression du début "Array (" et de la fin ")" pour n'avoir que les données du tableau d'origine
    let dataIntial = data.slice(8, data.length - 3);

    for (let pas = 0; pas < totalShop; pas++) {
      // console.log(dataIntial);
      // Génération d'un tableau utilisable par JS
      let num =
        dataIntial.slice(
          dataIntial.indexOf("[") + 1,
          dataIntial.indexOf("] => ")
        ) - 1;

      listShop[num] = [
        num,
        dataIntial.slice(
          dataIntial.indexOf("] => ") + 5,
          dataIntial.indexOf("\n")
        ),
      ];
      // console.log(pas + " - " + num + " - " + listShop[num]);

      // On retire ces éléments pour le filtrage suivant
      dataIntial = dataIntial.substring(dataIntial.indexOf("\n") + 1);
    }
    listShop[totalShop] = [
      totalShop,
      dataIntial.substring(dataIntial.indexOf("] => ") + 5),
    ];
    // console.log(listShop);
  }

  // const contactBtn = document.querySelectorAll(".contact");
  // const popupOverlay = document.querySelector(".popup-overlay");

  // Chargement de la pop magasin
  (function ($) {
    // Contrôle que JQuery est bien lancé et que la page est bien affichée
    $(document).ready(function () {
      $("#store_search").val("");
      $("body").click(function (e) {
        // e.preventDefault();
        console.log("Click Body !!!");
        console.log(e.target);
        // console.log("alt: " + e.target.alt);
        // console.log("class: " + e.target.className);
        // console.log("id: " + e.target.id);

        // Réinitiatisation de l'input quand on clic dedans
        // if (e.target.id == "store_search") {
        //   e.preventDefault();
        //   e.target.value = "";
        // }

        // Si c'est une donnée de la liste des magasins
        // Récupération de l'identifiant du magasin dans l'Id
        if (
          e.target.className == "shop_name" ||
          e.target.className == "shop_address" ||
          e.target.className == "store_list"
        ) {
          shopId = e.target.parentElement.id.substring(5);
          console.log(".shop_info_" + shopId);
          // shopInfo.classList.remove("hidden");
          $(".shop_info_" + shopId).removeClass("hidden");
          // $.popupShop();
        }

        // Si c'est un marqueur sur la carte
        // Récupération de l'identifiant dans le tableau
        if (typeof e.target.alt != "undefined") {
          alt = e.target.alt.substring(0, e.target.alt.indexOf("_"));
          console.log("Alt: " + alt);

          if (alt == "Marker") {
            console.log(e.target.alt);
            shopId = e.target.alt.substring(e.target.alt.indexOf("_") + 1);
            $(".shop_info_" + shopId).removeClass("hidden");
          }
        }

        // Si c'est la croix pour refermer la popup
        if (e.target.className == "popup-shop__close") {
          // console.log("REFEMER");
          $(".shop_info").addClass("hidden");
        }
      });
    });
  })(jQuery);
});
