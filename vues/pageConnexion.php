<!doctype html>
<html lang="fr">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	    <link rel="stylesheet" href="vues/css/bootstrap.css">
	    <link rel="stylesheet" href="vues/css/style.css">

	    <title>Connexion</title>
	</head>
  
<!-- MENU NAV -->
	<body>
		<nav class="navbar navbar-light bg-light">
		  <a class="navbar-brand" href="vues/acceuil.html">
		    <img src="vues/photos/menu.png" id="menu" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
		    To Do List
		  </a>
		</nav>
		<br>

<!--MENU CONNEXION-->

		<div id="co">
			<p><strong>Se connecter</strong></p>
			<form method="post" name="formAjout" id="formAjout">
				<div class="input-group mb-3">
					<input name="login" type="text" class="form-control" placeholder="login" aria-label="Username" aria-describedby="basic-addon1">
				</div>
				<div class="input-group mb-3">
					<input name="mdp" type="password" class="form-control" placeholder="mot de passe" aria-label="mdp" aria-describedby="basic-addon1">
				</div>
				<br>
                <input type="hidden" name="action" value="CONNEXION">
				<input id="validerCo" type="submit" class="btn btn-dark" value="Valider"/>
				<br>
			</form>
			<br>
			<a href="?action=FORM_INS" id="lieninscrit">
				<p>Si vous n'êtes pas inscrit(e), cliquez ici</p>
			</a>

			<br>

			<button type="button" onclick="location.href='?'" class="btn btn-dark">Retour à l'acceuil</button>
		</div>

<!-- FOOTER -->
 		<footer><p>Conceptrices du site : PONCET Clara & VELUT Lucile </p> |<p> Groupe 1 </p> </footer>

	
<!-- SCRIPTS JS -->
	    <script src="vues/js/bootstrap.min.js"></script>
	</body>
</html>
