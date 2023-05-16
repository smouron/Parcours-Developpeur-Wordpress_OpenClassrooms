<?php
// Gestion des filtres d'affichage
       
// Récupération des paramètres de filtre dans l'url
if (isset($_GET["categorie"])) {
    $categorie_id = $_GET["categorie"];
} else {
    $categorie_id = "";
}; 
if (isset($_GET["format"])) {
    $format_id = $_GET["format"];
} else {
    $format_id = "";
};   
if (isset($_GET["date"])) {
    $order = $_GET["date"];
} else {
    $order = "";
};  
?>

<div class="filter-area">
    <!-- <i class="fa-solid fa-caret-down"></i> -->
    <!-- <i class="fa-solid fa-caret-up"></i> -->
    <span class="dashicons dashicons-arrow-up"></span>
    <span class="dashicons dashicons-arrow-down"></span>
    <form class="flexrow" method="get" action="<?php echo 'http://127.0.0.1/nathalie-motta/index.php'; ?>">
    <!--  -->
    <!-- $terms->term_id :  -->
    <!-- $terms->taxonomy : nom de la taxonomie -->
    <!-- $terms->name : nom de l'élément de la taxonomie -->
    <!-- $terms->term_taxonomy_id : n° de l'élément de la taxonomie -->
        <div class="filterleft flexrow">
            <div class="select-filter flexcolumn">            
                <span class="myarrow"></i></span>
                <label for="categorie"><p>catégories</p></label>
                <!-- une balise select ou input ne peut pas être imbriquée directement dans form -->
                <select class="option-filter" name="categorie" id="categorie">
                    <option value=""></option>
                    <!-- Récupération de la liste des catégories -->
                    <?php
                        $categorie_acf = get_terms('categorie-acf', array('hide_empty' => false)); 
                        foreach ( $categorie_acf as $terms) : 
                    ?>
                        <?php if($terms->term_taxonomy_id == $categorie_id): ?>
                            <!-- ajoute "selected" si c'est un paramètre sélectionné dans les filtres -->
                            <option id="<?php echo $terms->term_taxonomy_id; ?>" value="<?php echo $terms->term_taxonomy_id; ?>" selected><?php echo $terms->name; ?></option>
                        <?php else : ?>
                            <option id="<?php echo $terms->term_taxonomy_id; ?>" value="<?php echo $terms->term_taxonomy_id; ?>"><?php echo $terms->name; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <!-- <input type="submit" value="catergorie" title="Catégorie" /> -->
            </div>
            <div class="select-filter flexcolumn">          
                <span class="myarrow"></span>
                <label for="format"><p>formats</p></label>
                <!-- une balise select ou input ne peut pas être imbriquée directement dans form -->
                <select class="option-filter" name="format" id="format"> 
                    <option value=""></option>
                    <!-- Récupération de la liste des formats -->
                    <?php
                        $format_acf = get_terms('format-acf', array('hide_empty' => false)); 
                        foreach ( $format_acf as $terms) : 
                    ?>
                        <option id="<?php echo $terms->term_taxonomy_id; ?>" value="<?php echo $terms->term_taxonomy_id; ?>"  
                        <?php if($terms->term_taxonomy_id == $format_id): ?>selected<?php endif; ?>><?php echo $terms->name; ?></option>
                    <?php endforeach; ?>
                </select>
                <!-- <input type="submit" value="format" title="Format" /> -->
            </div>
        </div>
        <div class="filterright flexrow">
            <div class="select-filter flexcolumn">          
                <span class="myarrow"></span>
                <label for="format"><p>trier par</p></label>
                <!-- une balise select ou input ne peut pas être imbriquée directement dans form -->
                <select class="option-filter" name="date" id="date">
                    <option value=""></option>
                    <option value="asc" <?php if($order === "asc" ): ?>selected<?php endif; ?>>nouveauté</option>
                    <option value="desc" <?php if($order === "desc"): ?>selected<?php endif; ?>>Les plus anciens</option>
                </select>
                <!-- <input type="submit" value="order" title="Date" /> -->
            </div>
        </div>
    </form>
</div>
