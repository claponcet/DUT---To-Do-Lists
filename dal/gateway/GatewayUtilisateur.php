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

    public function existe(string $login, string $mdp) : bool
    {
        $query='SELECT * FROM utilisateur WHERE nom=:login';
        $this->co->executeQuery($query,array(':login' => array($login,PDO::PARAM_STR)));
        $resultats=$this->co->getResultats();
        if (isset($resultats[0]['nom'])) {
            return password_verify($mdp,$resultats[0]['mdp']);
        }
        else {
            return false;
        }
    }

    public function existeLogin(string $login) : bool
    {
        $query='SELECT * FROM utilisateur WHERE nom=:login';
        $this->co->executeQuery($query,array(':login' => array($login,PDO::PARAM_STR)));
        $resultats=$this->co->getResultats();
        if (isset($resultats[0]['nom'])) return true;
        else return false;
    }

    public function getId(string $login) : ?int
    {
        $query='SELECT idutilisateur FROM utilisateur WHERE nom=:login';
        $this->co->executeQuery($query,array(':login' => array($login,PDO::PARAM_STR)));
        $resultats=$this->co->getResultats();
        if (isset($resultats[0]['idutilisateur'])) {
            return $resultats[0]['idutilisateur'];
        }
        else {
            return null;
        }
    }

    public function ajoutUtilisateur(string $login, string $mdp)
    {
        $query='INSERT INTO utilisateur VALUES(:idutilisateur,:nom,:mdp)';
        $this->co->executeQuery($query,array(':idutilisateur' => array('NULL',PDO::PARAM_NULL),
            ':nom' => array($login,PDO::PARAM_STR),
            ':mdp' => array(password_hash($mdp,PASSWORD_DEFAULT),PDO::PARAM_STR)));
    }

}