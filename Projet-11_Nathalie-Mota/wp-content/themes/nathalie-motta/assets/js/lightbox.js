// Script pour la gestion de la Lightbox sur toutes les photos

// console.log("Script lightbox lancé !!!");

// photo en pleine page

// Récupération des tous les icones Lightbox présent
const listOpenLightbox = document.querySelectorAll(".openLightbox");
const listLightbox = document.querySelectorAll(".lightbox");
const listLightboxClose = document.querySelectorAll(".lightbox__close");
const listLightboxPrev = document.querySelectorAll(".lightbox__prev");
const listLightboxNext = document.querySelectorAll(".lightbox__next");

// console.log(listOpenLightbox);
// console.log(listLightbox);

listOpenLightbox.forEach((openLightbox) => {
  openLightbox.addEventListener("click", (e) => {
    //   On stop le comportement par défaut
    e.preventDefault();
    // Récupération de l'élément du DOM qui suit l'icone pour afficher la Lightbox
    next = e.currentTarget.nextElementSibling;
    console.log(next);
    next.classList.remove("hidden");
  });
});

listLightboxClose.forEach((lightboxClose) => {
  lightboxClose.addEventListener("click", (e) => {
    e.preventDefault();
    // si on click sur la croix, cela referme la lightbox
    listLightbox.forEach((lightbox) => {
      lightbox.classList.add("hidden");
    });
  });
});

listLightboxPrev.forEach((lightboxPrev) => {
  lightboxPrev.addEventListener("click", (e) => {
    console.log(e);
    console.log("Photo précédent");
  });
});

listLightboxNext.forEach((lightboxNext) => {
  lightboxNext.addEventListener("click", (e) => {
    console.log(e);
    console.log("Photo suivante");
  });
});
