<?php


class Validation
{
    //Validation de l'action
    static function val_action(string $action) {

        return filter_var($action,FILTER_SANITIZE_STRING);

    }

    //Validation d'un entier (id, page, etc.)
    static function val_int(int $i, array &$tableauErreur) : int
    {
        if(isset($i)) {
            return abs(filter_var($i, FILTER_SANITIZE_NUMBER_INT));
        }
        else {
            $tableauErreur[] = "Mauvais passage de paramètre";
            return 0;
        }
    }

    //Validation du login
    static function val_login(string $login, array &$tableauErreur) {
        if ($login != filter_var($login, FILTER_SANITIZE_STRING))
        {
            $tableauErreur[] =	"Login invalide (attaque sécurité)";
            return "";
        }

        else {
            return filter_var($login, FILTER_SANITIZE_STRING);
        }
    }

    //Validation du mot de passe
    static function val_mdp(string $mdp, array &$tableauErreur) {
        if ($mdp != filter_var($mdp, FILTER_SANITIZE_STRING))
        {
            $tableauErreur[] =	"Mot de passe invalide (attaque sécurité)";
            return "";
        }
        else {
            return filter_var($mdp, FILTER_SANITIZE_STRING);
        }
    }

    //Validation de l'intitulé de la tâche
    static function val_tache(string &$intitule, array &$tableauErreur) {
        $intitule=trim($intitule," ");

        if ($intitule=="") {
            $tableauErreur[] =	"pas d'intitulé";
        }

        if ($intitule != filter_var($intitule, FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES))
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

        if ($titre != filter_var($titre, FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES))
        {
            $tableauErreur[] =	"tentative d'injection de code (attaque sécurité)";
            $titre="";
        }
    }

}
?>