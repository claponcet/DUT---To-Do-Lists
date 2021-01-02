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
		  <a class="navbar-brand" href="vues/acceuil.html">
		    <img src="vues/photos/menu.png" id="menu" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
		    To Do List
		  </a>
            <?php
            if (isset($_SESSION['login'])) {
                echo '<button type="button" onclick="location.href=' . "'" . 'index.php?action=DECONNEXION' . "'". '"
                     class="btn btn-dark">Déconnexion</button>';
            }
            else {
                echo '<button type="button" onclick="location.href=' . "'" . 'index.php?action=FORM_CO' . "'". '"
                     class="btn btn-dark">Connexion</button>';
            }
            ?>
		</nav>
		<br>


<!-- SWITCH LISTE PRIVEES
<img src="vues/photos/lock.jpg" id="imgprivee" width="40" height="40">
-->

	<div id="privee">
		<a id=priv href="#">
            <?php
                if (isset($_SESSION['login'])) {
                    echo '<button class="btn btn-dark" onclick="location.href=' . "'" . 'index.php?action=ALL_PRIV' . "'". '">
                    Voir les listes privées
                    </button>';
                }
            ?>
		</a>
	</div>

	<br>

<!-- LES LISTES -->

		<div class="list-group">
			<?php
			if(!empty($tabPub)) {
				foreach ($tabPub as $t) {
					$id=$t->getId();
					$titre=$t->titre;
					$url= "'" . 'index.php?action=VOIR_LISTE&idliste=' . $id . "'";
					echo '<button type="button" onclick="location.href=' . $url . '"' .
						' class="list-group-item list-group-item-action">'
						. $titre .'</button>' ;
				}
			}
			else {
				echo '<p>Aucune liste à afficher</p>';
			}?>
		</div>
        <br>

<!-- LES PAGES -->
        <div id="pagination">
            <?php
                if ($nbPages > 1)
                {
                    if ($page > 1)
                    {
                        echo '<a href="?page=' . ($page-1) . '"> <strong >page précédente <<< </strong> </a>';
                    }
                    echo '<a href="?page=' . $page . '"> <strong>' . $page . '</strong>   </a>';
                    if ($page<$nbPages)
                    {
                        echo '<a href="?page=' . ($page+1) . '"> <strong> >>> page suivante </strong> </a>';
                    }
                }
            ?>
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
						<input type="hidden" name="action" value="ADD_LISTE_PUB">
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
