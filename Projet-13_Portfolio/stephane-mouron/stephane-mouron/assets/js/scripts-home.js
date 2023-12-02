document.addEventListener("DOMContentLoaded", function () {

  // Contrôle apparition des sections
  const handleIntersect = (entries) => {
    entries.forEach(function (entry) {
      // Contrôle si l'élément à observer
      // est dans le ratio de la zone qui est affichée
      if (entry.intersectionRatio > ratio) {
        // elementName = entry.target.className;
        elementName = entry.target.id;
        // console.log(elementName + " est visible");

        // Si on trouve l'élément indiqué, on active l'animation d'apparition
        if (
          elementName === "oc_achievements" ||
          elementName === "lesson_achievements" ||
          elementName === "container__contact_form"
        ) {
          // On valide la class qui va executer le keyframes d'apparition des sections
          entry.target.classList.add("mouve-up");
          // On arrête l'observation sur cet élément
          observer.unobserve(entry.target);
          // On retire la class qui cachait par défaut l'élement
          entry.target.classList.remove("opacity0");
        }

        if (elementName === "about_right") {
          // On valide la class qui va executer le keyframes d'apparition des sections
          entry.target.classList.add("mouve-right");
          // On arrête l'observation sur cet élément
          observer.unobserve(entry.target);
          // On retire la class qui cachait par défaut l'élement
          entry.target.classList.remove("opacity0");
        }

        if (
          elementName === "about_left" ||
          elementName === "portfolio__title" ||
          elementName === "container__contact"
        ) {
          // On valide la class qui va executer le keyframes d'apparition des sections
          entry.target.classList.add("mouve-left");
          // On arrête l'observation sur cet élément
          observer.unobserve(entry.target);
          // On retire la class qui cachait par défaut l'élement
          entry.target.classList.remove("opacity0");
        }

        if (elementName === "first_separator") {
          // On valide la class qui va executer le keyframes d'apparition des sections
          entry.target.classList.add("grow-bigger");
          // On arrête l'observation sur cet élément
          observer.unobserve(entry.target);
          // On retire la class qui cachait par défaut l'élement
          entry.target.classList.remove("opacity0");
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
  observer.observe(document.querySelector("#about_left"));
  observer.observe(document.querySelector("#about_right"));
  observer.observe(document.querySelector("#portfolio__title"));
  observer.observe(document.querySelector("#oc_achievements"));
  observer.observe(document.querySelector("#first_separator"));
  observer.observe(document.querySelector("#lesson_achievements"));
  observer.observe(document.querySelector("#container__contact"));
  observer.observe(document.querySelector("#container__contact_form"));

});


 
