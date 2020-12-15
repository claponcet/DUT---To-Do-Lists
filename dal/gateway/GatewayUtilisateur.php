<?php


class GatewayUtilisateur
{
    public $co;

    /**
     * GatewayTache constructor.
     * @param $co
     */
    public function __construct()
    {
        global $dsn,$user,$mdp;
        $this->co=new Connexion($dsn,$user,$mdp);
    }

    //query ajouter un user

    //query verifier que l'utilisateur existe
}