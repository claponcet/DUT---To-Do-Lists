<?php

$chemin=__DIR__.'/../';

//BD

$dsn='mysql:host=localhost;dbname=projet_to_do';
$user='clara';
$mdp='lululafee';

//Vues

$lesVues['accueil']='vues/accueil.php';
$lesVues['uneListe']='vues/pageListe.php';
$lesVues['erreur']='vues/erreur.php';
$lesVues['privee']='vues/accueilPrive.php';
$lesVues['connexion']='vues/pageConnexion.php';
$lesVues['inscription']='vues/pageInscription.php';
?>