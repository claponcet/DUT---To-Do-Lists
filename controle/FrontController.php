<?php


class FrontController
{
    private array $tabActionsUtilisateur=["ALL_PRIV","NEW_PRIV","DECONNEXION"];

    public function __construct() {

        global $chemin, $lesVues;
        $tableauErreur = array();

        $m=new ModeleUtilisateur();
        $user=$m->isUser();

        $action = $_REQUEST['action'];
        if ($action != NULL) {
            $action = Validation::val_action($action);
        }

        if(in_array($action,$this->tabActionsUtilisateur))
        {
            if (isset($user)) {
                $controleUtilisateur = new ControleUtilisateur($action);
            }
            else {
                $tableauErreur[]="Vous n'êtes pas autorisé.e à effectuer cette action";
                require($chemin . $lesVues['erreur']);
            }
        }
        else
        {
            $controleVisiteur = new ControleVisiteur($action);
        }
    }
}