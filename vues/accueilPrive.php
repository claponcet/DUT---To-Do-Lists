<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="vues/css/bootstrap.css">
    <link rel="stylesheet" href="vues/css/style.css">

    <title>To do list</title>
</head>

<!-- MENU NAV -->
<body>
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="vues/photos/menu.png" id="menu" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
        To Do List
    </a>

    <button type="button" onclick="location.href='vues/pageConnexion.html'" class="btn btn-dark">Connexion</button>
</nav>
<br>


<!-- SWITCH LISTE PRIVEES -->

<div id="privee">
    <a id=priv href="#">
        <img src="vues/photos/lock.jpg" id="imgprivee" width="40" height="40">
    </a>
</div>

<br>

<!-- LES LISTES -->

<div class="list-group">
    <?php
    if(!empty($tabListes)) {
        foreach ($tabListes as $l) {
            $idL=$l->getId();
            $titre=$l->titre;
            $url= "'" . 'index.php?action=VOIR_LISTE&idliste='.$idL . "'";
            echo '<button type="button" onclick="location.href=' . $url . '"' .
                ' class="list-group-item list-group-item-action">'
                . $titre .'</button>' ;
        }
    }
    else {
        echo '<p>Aucune liste à afficher</p>';
    }?>
</div>

<!-- HIDDEN -->
<br>
<br>

<div>
    <button id="ajout" type="button" class="btn btn-outline-dark">Ajouter une liste</button>
    <nav id='sousmenu'>
        <form method="post" name="formAjout" id="formAjout">
            <div class="input-group input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Titre de la liste à ajouter</span>
                </div>
                <input type="text" name="titre" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                <input type="hidden" name="action" value="NEW_PRIV">
            </div>
            <br>
            <input id="valider" type="submit" class="btn btn-dark" value="Valider"/>
            <br>
        </form>
    </nav>

</div>


<!-- FOOTER -->
<footer><p>Conceptrices du site : PONCET Clara & VELUT Lucile </p> |<p> Groupe 1 </p> </footer>


<!-- SCRIPTS JS -->
<script src="vues/js/bootstrap.min.js"></script>
</body>
</html>
