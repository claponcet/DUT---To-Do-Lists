<?php
require('Tache.php');
require_once ('Utilisateur.php');

class Liste
{
    public string $titre;
    private bool $privee;
    public array $lesTaches=array();
    //public Utilisateur $auteur;
    private int $id;

    /**
     * Liste constructor.
     * @param int $id
     * @param string $titre
     * @param bool $privee
     */
    public function __construct(int $id, string $titre, bool $privee)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->privee = $privee;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
/*
    public static function privee(string $titre, bool $privee, Utilisateur $u)
    {
        $liste = new Liste( $titre, $privee);
        $liste->auteur=$u;
        return $liste;
    }

    public static function publique(string $titre, bool $privee)
    {
        return new Liste( $titre, $privee);
    }*/



    /**
     * @return bool
     */
    public function isPrivee(): bool
    {
        return $this->privee;
    }


    public function ajouterTache(Tache $tache)
    {
        $this->lesTaches[]=$tache;
    }

    public function supprimerTache(Tache $tache)
    {
        $index=array_search($tache,$this->lesTaches);
        unset($this->lesTaches[$index]);
    }

    public function affichage()
    {
        echo 'La liste ' . $this->titre . ' contient les tâches : ' . '<br>';
        foreach ($this->lesTaches as $t) {
            $checked = "non";
            if ($t->isEffectuee()==true)
            {
                $checked = "oui";
            }
            echo $t->getIntitule() . " " . $checked . "<br><br><br>";
        }
    }
}