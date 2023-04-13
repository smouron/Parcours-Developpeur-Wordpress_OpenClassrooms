/**
 * Custon Script 1.0.0
 *
 * Released on: April 2023
 */

// console.log("Démarrage du script !");

$(document).ready(function () {
  // console.log("HTML prêt !");

  let posX = 0;
  let mouveCloud = false;

  const root = document.documentElement;
  const place = document.querySelector("#place");

  // Gestion de la fermeture et de l'ouverture de la modale avec jQuery
  $(".modal-open").click(function () {
    console.log("modal-trigger cliqué");
    $(".modal__content").animate({ height: "toggle", opacity: "toggle" }, 1000);
    $(".modal__content").toggleClass("open");
    $(".modal__burger").toggleClass("close");
  });
  $("a").click(function () {
    if ($(".modal__content").hasClass("open")) {
      $(".modal__content").animate(
        { height: "toggle", opacity: "toggle" },
        1000
      );
      $(".modal__content").removeClass("open");
      $(".modal__burger").removeClass("close");
    }
  });

  // Gestion du déclenchement des évenements quand ils apparaissent
  const handleIntersect = (entries) => {
    entries.forEach(function (entry) {
      // Contrôle si l'élément à observer
      // est dans le ratio de la zone qui est affichée
      if (entry.intersectionRatio > ratio) {
        elementName = entry.target.className;
        if (
          elementName === "story hidden" ||
          elementName === "studio hidden" ||
          elementName === "nomination hidden" ||
          elementName === "site-footer hidden"
        ) {
          // On valide la class qui va executer le keyframes d'apparition des sections
          entry.target.classList.add("mouve-up");
          // On arrête l'observation sur cet élément
          observer.unobserve(entry.target);
          // On retire la class qui cachait par défaut l'élement
          entry.target.classList.remove("hidden");
        }

        if (
          elementName === "story__title hidden" ||
          elementName === "studio__title hidden" ||
          elementName === "characters__title hidden" ||
          elementName === "place__title hidden"
        ) {
          entry.target.classList.add("animTitle");
          observer.unobserve(entry.target);
          entry.target.classList.remove("hidden");
        }

        // Si on a trouvé un des nuages on active l'autorisation de déplacement
        if (
          elementName === "place--big_cloud" ||
          elementName === "place--little_cloud"
        ) {
          mouveCloud = true;
        } else {
          mouveCloud = false;
        }
      }
    });
  };

  const ratio = 0.05;
  // Initialisation de l'option pour la fonction IntersectionObserver
  // root :
  // ratio : % qui doit être visible de l'élement avant de déclencher l'action
  const options = {
    root: null,
    rootMargin: "0px",
    threshold: ratio,
  };

  // https://developer.mozilla.org/fr/docs/Web/API/Intersection_Observer_API
  // https://grafikart.fr/tutoriels/scroll-reveal-1176#autoplay
  //  Initialisation de la fonction IntersectionObserver
  const observer = new IntersectionObserver(handleIntersect, options);

  // Activation des éléments que l'on va surveiller
  observer.observe(document.querySelector(".story"));
  observer.observe(document.querySelector(".studio"));
  observer.observe(document.querySelector(".nomination"));
  observer.observe(document.querySelector(".site-footer"));
  observer.observe(document.querySelector(".story__title"));
  observer.observe(document.querySelector(".studio__title"));
  observer.observe(document.querySelector(".characters__title"));
  observer.observe(document.querySelector(".place__title"));
  observer.observe(document.querySelector(".place--big_cloud"));
  observer.observe(document.querySelector(".place--little_cloud"));

  // Contrôle si on scroll sur la fenêtre
  window.addEventListener("scroll", () => {
    // Si on scroll, cela accélère la rotation des fleurs
    // https://www.toutjavascript.com/reference/ref-window.scrolly.php
    var vertical = -1;
    setInterval(function () {
      if (window.scrollY != vertical) {
        vertical = window.scrollY;
        root.style.setProperty("--rotate", "3s");
      } else {
        root.style.setProperty("--rotate", "15s");
      }
    }, 500);

    // on ne bouge les nuages que s'ils ont été détécté à l'affichage
    if (mouveCloud) {
      posX = Math.round(0 - (window.scrollY - place.offsetTop - 200));
      if (posX <= 0 && posX > -400) {
        root.style.setProperty("--posX", posX + "px");
      }
    } else {
      posX = 0;
    }
  });
});
