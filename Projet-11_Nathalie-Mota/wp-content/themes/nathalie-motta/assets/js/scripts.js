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
    let divContent = $(".reference").text();
    divContent = divContent.substr(11, divContent.length);
    console.log(divContent);
    $(".refPhoto").val(divContent);
  });
  $("#contact_btn").click(function () {
    // $(".popup-overlay").show();
    $(".popup-overlay").toggleClass("hidden");
  });

  $(".photo__info--image").click(function () {
    $(".photo__full").toggleClass("hidden");
  });

  $(".lightbox").click(function () {
    $(".photo__full").toggleClass("hidden");
  });
})(jQuery);
