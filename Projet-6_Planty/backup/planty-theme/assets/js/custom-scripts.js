//
// Script pour gérer les boutons + et - des quantités dans le formulaire de commandes
//

// console.log("Démarrage du script !");

// On contrôle si on a bien la class ff_columns_total_4 pour indiquer que l'on a bien le formulaire
// si non, on ne fait rien
if(document.querySelector(".ff_columns_total_4")) {     
    // On pointe sur les class que l'on va vouloir contrôler   
    const qtFraises = document.querySelector(".qt-fraises");
    const qtPamplemousses = document.querySelector(".qt-pamplemousses");
    const qtFramboises = document.querySelector(".qt-framboises");
    const qtCitrons = document.querySelector(".qt-citrons"); 

    const container = document.querySelector(".ff_columns_total_4");

    // Si un click de souri est détectée sur le container des quantitées
    // on contrôle où a été fait le click 
    container.addEventListener("click", (e) => {
        let targetClassName = (e.target.className);
        if (targetClassName.indexOf('fraises') > 0) {
            // console.log ('Selection Fraises');
            if (targetClassName.indexOf('more') > 0) {
                // console.log ("Fraises +1");    
                qtFraises.value++;
            } else if ((targetClassName.indexOf('less') > 0) && (qtFraises.value > 0) ) {
                // console.log ("Fraises -1");    
                qtFraises.value--;
            } 
        }
        if (targetClassName.indexOf('pamplemousses') > 0) {
            // console.log ('Selection Pamplemousses');
            if (targetClassName.indexOf('more') > 0) {
                // console.log ("Pamplemousses +1");    
                qtPamplemousses.value++;
            } else if ((targetClassName.indexOf('less') > 0) && (qtPamplemousses.value > 0) ) {
                // console.log ("Pamplemousses -1");    
                qtPamplemousses.value--;
            } 
        }
        if (targetClassName.indexOf('framboises') > 0) {
            // console.log ('Selection Framboises');
            if (targetClassName.indexOf('more') > 0) {
                // console.log ("Framboises +1");    
                qtFramboises.value++;
            } else if ((targetClassName.indexOf('less') > 0) && (qtFramboises.value > 0) ) {
                // console.log ("Framboises -1");    
                qtFramboises.value--;
            } 
        }
        if (targetClassName.indexOf('citrons') > 0) {
            // console.log ('Selection Citrons');
            if (targetClassName.indexOf('more') > 0) {
                // console.log ("Citrons +1");    
                qtCitrons.value++;
            }else if ((targetClassName.indexOf('less') > 0) && (qtCitrons.value > 0) ) {
                // console.log ("Citrons -1");    
                qtCitrons.value--;
            } 
        }
    });
}