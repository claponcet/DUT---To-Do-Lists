<?php


class Validation
{
    //Validation de l'action
    static function val_action(string $action) {

        return filter_var($action,FILTER_SANITIZE_STRING);

    }

    static function val_int(int $i, array &$tableauErreur) : int
    {
        if(isset($i)) {
            return filter_var($i, FILTER_SANITIZE_NUMBER_INT);
        }
        else {
            $tableauErreur[] = "Mauvais passage de paramètre";
            return 0;
        }
    }

    //Validation de la connexion de l'utilisateur
    /*
    static function val_connexion(string &$nom, string &$mdp, array &$dataVueErreur) {

        if (!isset($nom)||$nom=="") {
            $dataVueErreur[] =	"pas de nom";
            $nom="";
        }

        if ($nom != filter_var($nom, FILTER_SANITIZE_STRING))
        {
            $dataVueErreur[] =	"tentative d'injection de code (attaque sécurité)";
            $nom="";

        }

        if (!isset($mdp)||$mdp=="") {
            $dataVueErreur[] =	"pas de mot de passe ";
            $mdp="";
        }

        if($mdp != filter_var($mdp, FILTER_SANITIZE_STRING)) {
            $dataVueErreur[] =	"tentative d'injection de code (attaque sécurité)";
            $mdp="";
        }

    }*/

    //Validation de l'intitulé de la tâche
    static function val_tache(string &$intitule, array &$tableauErreur) {
        $intitule=trim($intitule," ");

        if ($intitule=="") {
            $tableauErreur[] =	"pas d'intitulé";
        }

        if ($intitule != filter_var($intitule, FILTER_SANITIZE_STRING))
        {
            $tableauErreur[] =	"tentative d'injection de code (attaque sécurité)";
            $intitule="";
        }
    }

    //Validation du titre de la liste
    static function val_titre(string &$titre, array &$tableauErreur) {
        $titre=trim($titre," ");

        if ($titre=="") {
            $tableauErreur[] =	"pas de titre";
        }

        if ($titre != filter_var($titre, FILTER_SANITIZE_STRING))
        {
            $tableauErreur[] =	"tentative d'injection de code (attaque sécurité)";
            $titre="";
        }
    }

}
?>