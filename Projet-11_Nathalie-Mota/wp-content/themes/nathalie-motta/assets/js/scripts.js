console.log("Script lancé !!!");

const contactBtn = document.querySelectorAll(".contact");
const popupOverlay = document.querySelector(".popup-overlay");
const popupClose = document.querySelector(".popup-close");

// Gestion de la pagination des photos
(function ($) {
  $(document).ready(function () {
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


