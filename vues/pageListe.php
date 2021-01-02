<!doctype html>
<html lang="fr">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	    <link rel="stylesheet" href="vues/css/bootstrap.css">
	    <link rel="stylesheet" href="vues/css/style.css">

	    <title>Liste</title>
	</head>

	<body>

		<h1><?= $titre ?></h1>

		<br>
		<br>


		<div id="modif">
			<div class="w3-container">


				<button onclick="document.getElementById('id01').style.display='inline-block'" id="ajoutTache" class="btn btn-dark" class="w3-button w3-black">Ajouter une tâche</button>

				<div id="id01" class="w3-modal">
					<div class="w3-modal-content">

						<div class="w3-container">
							<form method="post" name="formAjoutTache" id="formAjoutTache">
								<div class="input-group input-group-lg">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-lg">Intitulé de la tache à ajouter</span>
									</div>
									<input type="text" name="intitule" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
									<input type="hidden" name="action" value="ADD_TACHE">
								</div>
								<br>
								<input id="valider" type="submit" class="btn btn-dark" value="Valider"/>
								<input id="retourTache" type="button" class="btn btn-dark" value="Annuler" onclick="document.getElementById('id01').style.display='none'"/>
								<br>
							</form>
						</div>
					</div>
				</div>
			</div>

			<?php
			$urlSupListe="'" . 'index.php?action=SUP_LISTE&idliste='.$id . "'";

			echo '<button type="button" onclick="location.href=' . $urlSupListe .
			'" class="btn btn-dark">Supprimer la liste</button>' ; ?>


		</div>
		<br>
		<br>

		<div id="taches">
			<?php
			if (!empty($tabTaches)) {
				foreach ($tabTaches as $t) {
					$intit=$t->getIntitule();
					$idTache=$t->getId();
					$urlSup="'" . 'index.php?action=SUP_TACHE&idTache=' . $idTache . '&idliste=' . $id . "'";
					$urlChange="'" . 'index.php?action=CHECK_TACHE&idTache=' . $idTache . '&idliste=' . $id . "'";
					if($t->isEffectuee()) {
						echo '<input type="checkbox" class="check" name="check"
						onchange="location.href=' . $urlChange . '" checked >';
					}
					else {
						echo '<input type="checkbox" class="check" name="check"
									 onchange="location.href=' . $urlChange . '" >';
					}
					echo '
						<label id="intit" for="check">' . $intit . '</label>
						<button id="bDelete" onclick="location.href=' . $urlSup . '"
						><img src="vues/photos/delete.png" id="imgdelete" width="23" height="23"></button><br>';
				}
			}
			else {
				echo '<p>Aucune tâche à afficher</p>';
			} ?>
		</div>

		<br>
		<br>
		<p id="retourAccueil">
			<button type="button" class="btn btn-dark" onclick="location.href='?'">Retour à l'accueil</button>
		</p>
		<br>
		<br>
		<br>
		<br>


<!-- FOOTER -->
 		<footer><p>Conceptrices du site : PONCET Clara & VELUT Lucile </p> |<p> Groupe 1 </p> </footer>

	
<!-- SCRIPTS JS -->
	    <script src="vues/js/bootstrap.min.js"></script>
	</body>
</html>