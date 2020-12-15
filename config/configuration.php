<?php

$chemin=__DIR__.'/../';

// liste des modules à inclure

//$dConfig['includes']= array('controleur/Validation.php');



//BD

$dsn='mysql:host=localhost;dbname=projet_to_do';
$user='clara';
$mdp='lululafee';

//Vues

$lesVues['accueil']='vues/accueil.html';
$lesVues['uneListe']='vues/pageListe.html';
$lesVues['erreur']='vues/erreur.html';
$lesVues['privee']='vues/accueilPrive.html';

?>