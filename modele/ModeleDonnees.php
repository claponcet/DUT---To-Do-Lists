<?php


class ModeleDonnees
{
    private GatewayListe $gwL;
    private GatewayTache $gwT;
    private int $nbListesParPage=5;

    public function __construct()
    {
        $this->gwL = new GatewayListe();
        $this->gwT = new GatewayTache();
    }

    public function getNbPagesPub()
    {
        $totalListes = $this->gwL->nbListesPub();
        $nbPages = ceil($totalListes/$this->nbListesParPage);
        return $nbPages;
    }

    public function getNbPagesPriv(int $id)
    {
        $totalListes = $this->gwL->nbListesPriv($id);
        $nbPages = ceil($totalListes/$this->nbListesParPage);
        return $nbPages;
    }

    public function getListesPubliques(int $page)
    {
        $premiereListe = ($page - 1) * $this->nbListesParPage;

        return $this->gwL->selectListesPubliques($premiereListe,$this->nbListesParPage);
    }

    public function getListesPrivees(int $id, int $page)
    {
        $premiereListe = ($page - 1) * $this->nbListesParPage;

        return $this->gwL->selectListesPrivees($id,$premiereListe,$this->nbListesParPage);
    }

    public function addPublique(String $titre)
    {
        $this->gwL->ajouterListePublique($titre);
    }

    public function addPrivee(String $titre, int $id)
    {
        $this->gwL->ajouterListePrivee($titre,$id);
    }

    public function deleteListe(int $id)
    {
        $this->gwL->supprimerListe($id);
    }

    public function getTitre(int $id)
    {
        return $this->gwL->getTitre($id);
    }

    public function getTache(int $id)
    {
        return $this->gwT->selectTache($id);
    }

    public function addTache(String $titre, int $id)
    {
        $this->gwT->ajouterTache($titre,$id);
    }

    public function deleteTache(int $id)
    {
        $this->gwT->supprimerTache($id);
    }

    public function getById(int $id) : Tache
    {
        return $this->gwT->getById($id);
    }

    public function checkTache(int $id)
    {
        $this->gwT->cocherTache($id);
    }

    public function uncheckTache(int $id)
    {
        $this->gwT->decocherTache($id);
    }

}