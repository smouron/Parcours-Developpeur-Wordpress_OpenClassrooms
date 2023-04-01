//
// Script pour gérer les boutons + et - des quantités dans le formulaire de commandes
//

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

  const body = document.querySelector("body");
  const banner = document.querySelector(".banner");
  const bannerVideo = document.querySelector(".banner__video");
  const bannerLogo = document.querySelector(".banner__logo");
  const place = document.querySelector(".place");

  const heightControlBanner = bannerLogo.offsetHeight / 2 - 20;

  console.log(banner);
  console.log(
    "offsetHeight: " +
      banner.offsetHeight +
      " - clientHeight: " +
      banner.clientHeight +
      " - heightControlBanner: " +
      heightControlBanner
  );
  console.log(bannerVideo);
  console.log(bannerLogo);

  //   Intitialisation position de l'image titre dans le header par rapport au scroll
  if (window.scrollY < heightControlBanner) {
    bannerLogo.style.setProperty("--transy", window.scrollY + "px");
  } else {
    bannerLogo.style.setProperty("--transy", heightControlBanner + "px");
  }

  //   Gestion de la position de l'image titre dans le header par rapport au scroll
  window.addEventListener("scroll", () => {
    let scrollValue =
      (window.scrollY + window.innerHeight) / document.body.offsetHeight;

    console.log(scrollValue * 10);

    if (window.scrollY < heightControlBanner) {
      bannerLogo.style.setProperty("--transy", window.scrollY + "px");
    } else {
      bannerLogo.style.setProperty("--transy", heightControlBanner + "px");
    }
  });

  // --rotate

  document.addEventListener(
    "mouseover",
    (e) => {
      // on met l'accent sur la cible de mouseover
      // console.log("id: " + e.target.id + " - class: " + e.target.className);
      e.target.style.color = "orange";
      setTimeout(function () {
        e.target.style.color = "";
      }, 600);
    },
    false
  );
}
