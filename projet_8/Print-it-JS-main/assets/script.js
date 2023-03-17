//
// Script pour gérer le slider
//

// console.log("Démarrage du script !");

const slides = [
	{
		"image":"slide1.jpg",
		"tagLine":"Impressions tous formats <span>en boutique et en ligne</span>"
	},
	{
		"image":"slide2.jpg",
		"tagLine":"Tirages haute définition grand format <span>pour vos bureaux et events</span>"
	},
	{
		"image":"slide3.jpg",
		"tagLine":"Grand choix de couleurs <span>de CMJN aux pantones</span>"
	},
	{
		"image":"slide4.png",
		"tagLine":"Autocollants <span>avec découpe laser sur mesure</span>"
	}
]

const bannerImg = document.querySelector(".banner-img");
const arrowLeft = document.querySelector(".arrow_left");
const arrowRight = document.querySelector(".arrow_right");
const dot1 = document.getElementById("dot1");
const dot2 = document.getElementById("dot2");
const dot3 = document.getElementById("dot3");
const dot4 = document.getElementById("dot4");
const dot = document.querySelector(".dot");
let posDot = 0;

// Controle de la fleche gauche
arrowLeft.addEventListener("click", () => {
	if (posDot <= 0) {
		posDot = 3;
	} else {
		posDot--;
	}
	updateSlider(posDot);
});

// Controle de la fleche droite
arrowRight.addEventListener("click", () => {
	if (posDot >= 3) {
		posDot = 0;
	} else {
		posDot++;
	}	
	updateSlider(posDot);
});

// Controle des 4 dots
dot1.addEventListener("click", () => {
	posDot = 0;
	updateSlider(posDot);
});

dot2.addEventListener("click", () => {
	posDot = 1;
	updateSlider(posDot);
});

dot3.addEventListener("click", () => {
	posDot = 2;
	updateSlider(posDot);
});

dot4.addEventListener("click", () => {
	posDot = 3;
	updateSlider(posDot);
});

// Selection du Dot et changement de l'image avec le texte
const updateSlider = (arg) => {
	arg == 0 ? dot1.classList.add("dot_selected") : dot1.classList.remove("dot_selected");
	arg == 1 ? dot2.classList.add("dot_selected") : dot2.classList.remove("dot_selected");
	arg == 2 ? dot3.classList.add("dot_selected") : dot3.classList.remove("dot_selected");
	arg == 3 ? dot4.classList.add("dot_selected") : dot4.classList.remove("dot_selected");
	let srcImage = "./assets/images/slideshow/" + slides[arg]['image'];
	bannerImg.src = srcImage;
	bannerImg.alt = slides[arg]['tagLine'];
}

// updateSlider(posDot);