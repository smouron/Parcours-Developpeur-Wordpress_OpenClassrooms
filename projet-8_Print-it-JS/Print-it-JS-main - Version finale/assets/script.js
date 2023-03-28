//
// Script pour gérer le slider
//

// console.log("Démarrage du script !");

const slides = [
  {
    image: "slide1.jpg",
    tagLine: "Impressions tous formats <span>en boutique et en ligne</span>",
  },
  {
    image: "slide2.jpg",
    tagLine:
      "Tirages haute définition grand format <span>pour vos bureaux et events</span>",
  },
  {
    image: "slide3.jpg",
    tagLine: "Grand choix de couleurs <span>de CMJN aux pantones</span>",
  },
  {
    image: "slide4.png",
    tagLine: "Autocollants <span>avec découpe laser sur mesure</span>",
  },
];

// Calcul du nombre d'élements pour le slider
let nbElement = slides.length - 1;
// Position de départ du slider
let numDot = 0;
// Emplacement des images
let srcImage = "./assets/images/slideshow/";

// On pointe sur les élements suivants
const bannerImg = document.querySelector(".banner-img");
const bannerText = document.querySelector(".banner-text");
const arrowLeft = document.querySelector(".arrow_left");
const arrowRight = document.querySelector(".arrow_right");
const dots = document.querySelector(".dots");

// Le script est lancé donc on fait afficher les flêches
arrowLeft.classList.remove("hidden");
arrowRight.classList.remove("hidden");

// Mise en place des points de sélection
for (let pas = 0; pas <= nbElement; pas++) {
  dots.innerHTML +=
    '<span id="dot' +
    pas +
    '" class="dot" title="Image ' +
    (pas + 1) +
    '"></span>';
}

// On place dans une liste tous les élements ayant la class dot
const dotList = document.querySelectorAll(".dot");

// On met en place un cercle plein pour le point qui est actif
// et on repasse à un cercle vide pour les autres points
const addSelected = () => {
  for (let pas = 0; pas <= nbElement; pas++) {
    if (pas === numDot) {
      dotList[pas].classList.add("dot_selected");
    } else {
      dotList[pas].classList.remove("dot_selected");
    }
  }
};

// Selection du Dot actif et chargement de l'image avec le texte
const updateSlider = (arg) => {
  bannerImg.src = srcImage + slides[arg]["image"];
  bannerImg.alt = "Banner Print-it - " + slides[arg]["image"];
  bannerText.innerHTML = slides[arg]["tagLine"];
  addSelected();
};

// Mise en place de l'image de départ du slider avec le texte
updateSlider(numDot);

// on récupère l'id qui est dans target dans la liste des élements "dot"
// et on ne prend que la valeur finale qui est le n° du dot
dots.addEventListener("click", (e) => {
  if (e.target.id != "" && e.target.id != null) {
    numDot = parseInt(e.target.id.substring(3));
  }
  updateSlider(numDot);
});

// Controle de la fleche gauche
arrowLeft.addEventListener("click", () => {
  if (numDot <= 0) {
    numDot = nbElement;
  } else {
    numDot--;
  }
  updateSlider(numDot);
});

// Controle de la fleche droite
arrowRight.addEventListener("click", () => {
  if (numDot >= nbElement) {
    numDot = 0;
  } else {
    numDot++;
  }
  updateSlider(numDot);
});
