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
  const filtreCategorie = document.getElementById("categorie");
  const filtreFormat = document.getElementById("format");
  const filtreDate = document.getElementById("date");
  const filtres = document.querySelectorAll(".option-filter");

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

      console.log(filtre);

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
}
