console.log("Script lancé !!!");

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
})(jQuery);
