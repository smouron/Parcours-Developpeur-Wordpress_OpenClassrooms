console.log("Script lancé !!!");

const photoInfo = document.querySelector(".photo__info--image");

// Gestion de la fermeture et de l'ouverture de la modale avec jQuery
(function ($) {
  $(".popup-close").click(function () {
    // $(".popup-overlay").hide();
    $(".popup-overlay").toggleClass("hidden");
  });
  $("#contact_btn_navbar").click(function () {
    // $(".popup-overlay").show();
    $(".popup-overlay").toggleClass("hidden");
  });
  $("#contact_btn").click(function () {
    // $(".popup-overlay").show();
    $(".popup-overlay").toggleClass("hidden");
  });

  $(".photo__info--image").click(function () {
    $(".photo__full").toggleClass("hidden");
  });

  $(".photo__full").click(function () {
    $(".photo__full").toggleClass("hidden");
  });
})(jQuery);

photoInfo.addEventListener("mouseenter", (e) => {
  console.log(e);
});

photoInfo.addEventListener("mouseover", (e) => {
  console.log(e);
});
