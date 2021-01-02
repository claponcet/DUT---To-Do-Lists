<?php


abstract class Controle
{
    protected array $tableauErreur = array();

    public function accueil() {
        global $chemin, $lesVues;

        $m = new ModeleDonnees();

        $nbPages = $m->getNbPagesPub();

        $page = (isset($_GET['page'])) ? Validation::val_int($_GET['page'], $this->tableauErreur) : 1;
        $page = 0 ? 1 : $page; //si la page est à zéro, on la met à 1, sinon on la laisse

        if (!empty($this->tableauErreur)) {
            require($chemin . $lesVues['erreur']);
        }
        else {
            $tabPub = $m->getListesPubliques($page);
            require($chemin . $lesVues['accueil']);
        }
    }
}