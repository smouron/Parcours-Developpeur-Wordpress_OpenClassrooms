document.addEventListener("DOMContentLoaded", function () {
  console.log("HTML prêt. Lancement du script !!!");

  // Initialisation des variables
  const allPost = document.querySelectorAll(".article_details");
  const allFilter = document.querySelectorAll(".list_filter");
  let word = "null";
  let searchWord = "null";
  let pas = 0;
  let className = "";
  let innerText = "";
  let therme = 0;

  // Gestion des filtres de la page de la liste des réalisations
  // au click sur un des boutons des filtres
  allFilter.forEach((filter) => {
    // console.log(allFilter.NodeList[0]);
    filter.addEventListener("click", (e) => {
      // mot sélectionné
      word = e.target.textContent.toLowerCase();
      console.log(searchWord);
      if (word == "tout") {
        searchWord = "css";
      } else {
        searchWord = word;
      }
      desactiveBtn();
      research();
    });
  });

  const desactiveBtn = () => {
    // Désactivation de tous les filtres
    // et activation de celui qui a été cliqué

    // allFilter.length = nombre de lignes filtre
    // allFilter[0].children.length = nombre de filtre dans la ligne 0
    for (let pas = 0; pas < allFilter.length; pas++) {
      for (
        let numfilter = 0;
        numfilter < allFilter[pas].children.length;
        numfilter++
      ) {
        // outerText : texte présent dans la balise <li>
        if (
          allFilter[pas].children[numfilter].outerText.toLowerCase() == word
        ) {
          allFilter[pas].children[numfilter].classList.add("active");
        } else {
          allFilter[pas].children[numfilter].classList.remove("active");
        }
      }
    }
  };

  const research = () => {
    // recherche le nombre de Post détecté
    let nbPost = allPost.length;
    console.log(
      "Nombre de post trouvé: " +
        nbPost +
        " - Elément recherché: '" +
        searchWord +
        "'"
    );
    allPost.forEach((blockPost) => {
      // console.log(blockPost.firstChild);
      // Recherche du nombre d'élément 'Post' qu'il y a sur la page
      let nbElement = blockPost.firstChild.childElementCount;
      //
      // On fait une boucle pour rechercher la présence de la class taxonomy-techno-acf dans les éléments enfants
      // Si taxonomy-techno-acf est présente, on recherche la présence dans son enfant du mot à filtrer
      //
      pas = 0;
      therme = 0;
      do {
        className = blockPost.firstChild.children[pas].className.toLowerCase();
        // On recherche la présence de la class 'taxonomy-techno-acf' dans les élements enfants
        if (className.search("taxonomy-techno-acf") > -1) {
          // Si on trouve la class, on va ensuite rechercher dans les class des éléments enfants
          innerText = blockPost.firstChild.children[
            pas
          ].innerText.toLowerCase();
          let childElementCount =
            blockPost.firstChild.children[pas].childElementCount;
          for (let index = 0; index < childElementCount; index++) {
            let childClass =
              blockPost.firstChild.children[pas].children[index].className;
            if (childClass.search(searchWord) > -1) {
              // Le mot recherché a été trouvé dans une class.
              console.log("Mot recherché trouvé !!!");
              // On incrémente la recherche pour indiquer que l'article doit être affiché
              therme++;
            }
          }
        }
        if (therme == 0) {
          // Le mot recherché n'est pas présent. On cache l'élément du DOM
          blockPost.classList.add("hidden");
        } else {
          // Le mot recherché est pas présent. On retire la présence éventuelle de la balise hidden;
          blockPost.classList.remove("hidden");
        }
        pas++;
      } while (pas < nbElement);
    });
  };

  if (document.querySelector(".mySwiper")) {
    // Initialize et configuration de Swiper
    var swiper = new Swiper(".mySwiper", {
      loop: true,
      spaceBetween: 10,
      slidesPerView: 3,
      grabCursor: true,
      centeredSlides: true,
      effect: "fade",
      autoplay: {
        delay: 8000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
        renderBullet: function (index, className) {
          return '<span class="' + className + '">' + (index + 1) + "</span>";
        },
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  }
});
