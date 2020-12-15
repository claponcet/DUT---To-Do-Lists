<?php


class GatewayTache
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

    public function selectTache(int $id) : array
    {
        $tabTache=array();
        $query='SELECT * FROM tache WHERE idliste=:idliste';
        $this->co->executeQuery($query,array(':idliste' => array($id,PDO::PARAM_INT)));
        $resultats=$this->co->getResultats();
        foreach($resultats as $row)
        {
            if($row['effectuee']=='VRAI') {
                $tabTache[]=new Tache($row['idtache'],$row['intitule'],true);
            }
            else {
                $tabTache[]=new Tache($row['idtache'],$row['intitule'],false);
            }
        }
        return $tabTache;
    }

    /*
    public function nbTaches() : int
    {
        $query='SELECT COUNT(*) FROM tache';
        $this->co->executeQuery($query,array());
        $resultats=$this->co->getResultats();
        return $resultats[0]['COUNT(*)'];
    }*/

    public function getById(int $id) : Tache
    {
        $tabTache=array();
        $query='SELECT idtache,intitule,effectuee FROM tache WHERE idtache=:id';
        $this->co->executeQuery($query,array(':id' => array($id,PDO::PARAM_INT)));
        $resultats=$this->co->getResultats();
        foreach($resultats as $row)
        {
            if($row['effectuee']=='VRAI') {
                $tabTache[]=new Tache($row['idtache'],$row['intitule'],true);
            }
            else {
                $tabTache[]=new Tache($row['idtache'],$row['intitule'],false);
            }
        }
        return $tabTache[0];
    }

    public function ajouterTache(string $intitule, int $idliste) : void
    {
        $query="INSERT INTO tache VALUES(:idtache,:intitule,:bool,:idliste)";
        $this->co->executeQuery($query,array(':idtache' => array('NULL',PDO::PARAM_NULL),
            ':intitule' => array($intitule,PDO::PARAM_STR),
            ':bool' => array('FAUX',PDO::PARAM_STR),
            ':idliste' => array($idliste,PDO::PARAM_INT)));
    }

    public function cocherTache(int $id) : void
    {
        $query="UPDATE tache SET effectuee='VRAI' WHERE idtache=:id";
        $this->co->executeQuery($query,array(':id' => array($id,PDO::PARAM_INT)));
    }

    public function decocherTache(int $id) : void
    {
        $query="UPDATE tache SET effectuee='FAUX' WHERE idtache=:id";
        $this->co->executeQuery($query,array(':id' => array($id,PDO::PARAM_INT)));
    }

    public function supprimerTache(int $id) : void
    {
        $query="DELETE FROM tache WHERE idtache=:id";
        $this->co->executeQuery($query,array(':id' => array($id,PDO::PARAM_INT)));
    }
}