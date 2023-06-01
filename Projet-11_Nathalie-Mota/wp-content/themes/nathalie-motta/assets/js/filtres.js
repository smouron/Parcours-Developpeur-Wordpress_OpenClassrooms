// console.log("Script filtres lancé !!!");

// Différer le lancement du script => ne se lance qu'une fois que tout le HTML a été chargé
if (document.readyState === "complete") {
  monScript();
} else {
  document.addEventListener("DOMContentLoaded", function () {
    monScript();
  });
}

function monScript() {
  // Script JS pour gestion des filtres

  const body = document.querySelector("body");
  const filtres = document.querySelectorAll(".option-filter");
  const allDashicons = document.querySelectorAll(".dashicons");
  const allSelect = document.querySelectorAll("select");

  // Initialiastion des données à rajouter à l'url
  let valueCategorie = "?categorie=";
  let valueFormat = "&format=";
  let valueDate = "&date=";
  let valueSubmit = valueCategorie + valueFormat + valueDate;

  // Récupération de l'url
  let urlHref = window.location.href;
  let url = new URL(urlHref);
  let chemin = window.location.pathname + "index.php";

  // Quand une nouvelle <option> est selectionnée
  filtres.forEach((filtre) => {
    filtre.addEventListener("change", function () {
      // Récupération du filtre sélectionné
      let filtreName = filtre.name;
      let filtreValue = filtre.value;

      let index = filtre.selectedIndex;

      // Recherce dans l'URL la présence des paramètres des filtres
      // s'ils sont présents, on récupère les valeurs actuelles
      let search = url.searchParams.get("categorie");

      // Si le paramètre est dans l'URL et qu'elle est numérique, on la récupère
      if (search && Number(search)) {
        console.log(url.searchParams.get("categorie"));
        valueCategorie = "?categorie=" + search;
      }

      search = url.searchParams.get("format");
      if (search && Number(search)) {
        console.log(url.searchParams.get("format"));
        valueFormat = "&format=" + search;
      }

      search = url.searchParams.get("date");
      if (search) {
        console.log(url.searchParams.get("date"));
        valueDate = "&date=" + search;
      }

      if (filtreName === "categorie") {
        valueCategorie = "?categorie=" + filtreValue;
      }

      if (filtreName === "format") {
        valueFormat = "&format=" + filtreValue;
      }

      if (filtreName === "date") {
        valueDate = "&date=" + filtreValue;
      }

      // Ajout des données à la page
      valueSubmit = valueCategorie + valueFormat + valueDate;
      chemin = "index.php" + valueSubmit;

      // Rechargement de la page avec la nouvelle URL
      window.location.href = "index.php" + valueSubmit;
    });
  });

  // Réinitialisation des flèches des select si on click en dehors
  body.addEventListener("click", (e) => {
    if (e.target.tagName != "select" && e.target.tagName != "SELECT") {
      initArrow();
    }
  });

  // Fonction pour rechercher un mot dans une variable
  // retourne vrai si le mot est trouvé, si non retourne false
  function findWord(word, str) {
    return RegExp("\\b" + word + "\\b").test(str);
  }

  // Réinitialisation de l'affichage des flèches sur les select
  const initArrow = () => {
    allDashicons.forEach((dashicons) => {
      if (findWord("up", dashicons.className)) {
        dashicons.classList.add("hidden");
      }
      if (findWord("down", dashicons.className)) {
        dashicons.classList.remove("hidden");
      }
    });
  };

  // Passer de la flèche qui descend à la flèqhe qui monte
  // et inversement
  // et force la flèche qui descend sur les 2 autres selects
  const arrow = (arg) => {
    allDashicons.forEach((dashicons) => {
      if (findWord(arg, dashicons.className)) {
        if (
          findWord("up", dashicons.className) ||
          findWord("down", dashicons.className)
        ) {
          dashicons.classList.toggle("hidden");
        }
      } else {
        if (findWord("up", dashicons.className)) {
          dashicons.classList.add("hidden");
        }
        if (findWord("down", dashicons.className)) {
          dashicons.classList.remove("hidden");
        }
      }
    });
  };

  // Détection du click sur un select
  // et modification de la flèche correpondante
  allSelect.forEach((select) => {
    select.addEventListener("click", (e) => {
      e.preventDefault();
      // initArrow();
      arrow(select.id);
    });
  });

  // Gestion du déplacement des filtres horizontalement
  const swiper = new Swiper(".swiper-container", {
    freeMode: true,
    grabCursor: true,
  });
}
