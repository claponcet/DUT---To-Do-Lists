<?php


class FrontController
{
    private array $tabActionsUtilisateur=["ALL_PRIV","NEW_PRIV","DECONNEXION"];

    public function __construct() {

        $action = $_REQUEST['action'];
        if ($action != NULL) {
            $action = Validation::val_action($action);
        }

        if(in_array($action,$this->tabActionsUtilisateur))
        {
            $controleUtilisateur = new ControleUtilisateur($action);
        }
        else
        {
            $controleVisiteur = new ControleVisiteur($action);
        }
    }
}