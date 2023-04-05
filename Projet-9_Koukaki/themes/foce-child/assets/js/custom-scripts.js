console.log("Démarrage du script !");

// Différer le lancement du script => ne se lance qu'une fois que tout le HTML a été chargé
if (document.readyState === "complete") {
  monScript();
} else {
  document.addEventListener("DOMContentLoaded", function () {
    monScript();
  });
}

function monScript() {
  console.log("HTML prêt !");

  let posX = 0;
  let mouveCloud = false;

  const root = document.documentElement;
  const place = document.querySelector("#place");
  const littleCloud = document.querySelector(".place--little_cloud");
  const bigCloud = document.querySelector(".place--big_cloud");

  const handleIntersect = function (entries, observer) {
    entries.forEach(function (e) {
      // Contrôle si l'élément à observer
      // est dans le ratio de la zone qui est affichée
      console.log(e.target);
      if (e.intersectionRatio > ratio) {
        elementName = e.target.className;
        console.log(elementName + " est visible");
        if (
          elementName === "story hidden" ||
          elementName === "studio hidden" ||
          elementName === "nomination hidden" ||
          elementName === "site-footer hidden"
        ) {
          // On valide la class qui va executer le keyframes d'apparition des sections
          e.target.classList.add("mouve-up");
          // On arrête l'observation sur cet élément
          observer.unobserve(e.target);
          // On retire la class qui cachait par défaut l'élement
          e.target.classList.remove("hidden");
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

  const ratio = 0.1;
  // Initialisation de l'option pour la fonction IntersectionObserver
  // root :
  // threshold : 0.1 = 10% qui doit être visible de l'élement avant de déclencher l'action
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
  observer.observe(bigCloud);
  observer.observe(littleCloud);

  console.log(
    "La résolution d'écran est: " + screen.width + " x " + screen.height
  );

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
      console.log("posX: " + posX);
      if (posX <= 0 && posX > -400) {
        root.style.setProperty("--posX", posX + "px");
      }
    } else {
      posX = 0;
    }
  });
}
