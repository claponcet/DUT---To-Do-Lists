<?php


class GatewayListe
{
    public $co;

    /**
     * GatewayListe constructor.
     * @param $co
     */
    public function __construct()
    {
        global $dsn,$user,$mdp;
        $this->co=new Connexion($dsn,$user,$mdp);
    }

    public function selectListesPubliques(): array
    {
        $tabPub= array();
        $query="SELECT * FROM liste WHERE privee='NON'";
        $this->co->executeQuery($query,array());
        $resultats=$this->co->getResultats();
        foreach($resultats as $row)
        {
            $tabPub[]=new Liste($row['idliste'],$row['titre'],false);
        }
        return $tabPub;
    }

    public function selectListesPrivees(int $id): array
    {
        $tabPriv = array();
        $query='SELECT * FROM liste WHERE privee="OUI" AND idauteur=:idauteur ORDER BY (idliste)';
        $this->co->executeQuery($query,array(':idauteur' => array($id,PDO::PARAM_INT)));
        $resultats=$this->co->getResultats();
        foreach($resultats as $row)
        {
            $tabPriv[]=new Liste($row['idliste'],$row['titre'],true);
        }
        return $tabPriv;
    }

    //séparer nb listes publiques et privées
    /*
    public function nbListes() : int
    {
        $query='SELECT COUNT(*) FROM liste';
        $this->co->executeQuery($query,array());
        $resultats=$this->co->getResultats();
        return $resultats[0]['COUNT(*)'];
    }*/

    public function ajouterListePublique(string $titre) : void
    {
        $query="INSERT INTO liste VALUES(:id,:titre,:priv,:idauteur)";
        $this->co->executeQuery($query,array(':id' => array('NULL', PDO::PARAM_NULL),
            ':titre' => array($titre,PDO::PARAM_STR),
            ':priv' => array('NON',PDO::PARAM_STR),
            ':idauteur' => array('NULL',PDO::PARAM_NULL)));
    }

    public function ajouterListePrivee(string $titre, int $id) : void
    {
        $query="INSERT INTO liste VALUES(:id,:titre,:priv,:idauteur)";
        $this->co->executeQuery($query,array(':id' => array('NULL', PDO::PARAM_NULL),
            ':titre' => array($titre,PDO::PARAM_STR),
            ':priv' => array('OUI',PDO::PARAM_STR),
            ':idauteur' => array($id,PDO::PARAM_INT)));
    }

    public function supprimerListe(int $id) : void
    {
        $query='DELETE FROM liste WHERE idliste=:id';
        $this->co->executeQuery($query,array(':id' => array($id, PDO::PARAM_INT)));
    }

    public function getTitre(int $id) : string
    {
        $query='SELECT titre FROM liste WHERE idliste=:id';
        $this->co->executeQuery($query,array(':id' => array($id, PDO::PARAM_INT)));
        $resultats=$this->co->getResultats();
        return $resultats[0]['titre'];
    }
}