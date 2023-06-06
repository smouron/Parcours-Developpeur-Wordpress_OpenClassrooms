document.addEventListener("DOMContentLoaded", function () {
  // console.log("Script principal lancé !!!");

  const contactBtn = document.querySelectorAll(".contact");
  const popupOverlay = document.querySelector(".popup-overlay");
  const popupClose = document.querySelector(".popup-close");

  // Gestion de la pagination des photos
  (function ($) {
    $(document).ready(function () {
      // Gestion de la fermeture et de l'ouverture du menu
      // dans une modale pour la version mobile
      $(".btn-modal").click(function (e) {
        $(".modal__content").toggleClass("animate-modal");
        $(".modal__content").toggleClass("open");
        $(".btn-modal").toggleClass("close");
      });
      $("a").click(function () {
        if ($(".modal__content").hasClass("open")) {
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
      // Si une référence photo existe on la récupére et on l'ajoute dans le formulaire
      if (document.querySelector(".reference") !== null) {
        let ref = document.querySelector(".reference").innerText.substring(11);
        ref = ref.trim();
        if (document.querySelector(".refPhoto") !== null) {
          document.querySelector(".refPhoto").value = ref;
        }
      }
    });
  });

  // Refermeture de la pop contact au clic
  popupClose.addEventListener("click", () => {
    popupOverlay.classList.add("hidden");
  });
});
