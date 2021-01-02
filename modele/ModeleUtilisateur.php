<?php


class ModeleUtilisateur
{
    private GatewayUtilisateur $gw;

    public function __construct()
    {
        $this->gw = new GatewayUtilisateur();
    }

    public function isUser() : ?Utilisateur
    {
        $tableauErreur = array();
        global $chemin, $lesVues;

        if (isset($_SESSION['login']) && isset($_SESSION['id'])) {

            $login = Validation::val_login($_SESSION['login'], $tableauErreur);
            $id = Validation::val_int($_SESSION['id'], $tableauErreur);
            $user = new Utilisateur($login, $id);
            if (!empty($tableauErreur)) {
                require($chemin . $lesVues['erreur']);
                return null;
            } else {
                return $user;
            }
        }
        return null;
    }

    public function connexion(string $login, string $mdp) : ?Utilisateur
    {
        $gw = new GatewayUtilisateur();
        if ($gw->existe($login,$mdp)){
            $id=$gw->getId($login);
            $_SESSION['login']=$login;
            $_SESSION['id']=$id;
            return new Utilisateur($login, $id);
        }
        else {
            return null;
        }
    }

    public function inscription(string $login, string $mdp) : bool
    {
        $gw = new GatewayUtilisateur();
        if ($gw->existeLogin($login)==false){
            $gw->ajoutUtilisateur($login,$mdp);
            $id=$gw->getId($login);
            $_SESSION['login']=$login;
            $_SESSION['id']=$id;
            return true;
        }
        else return false;
    }
    //fonction ajouter un user -> inscription

}