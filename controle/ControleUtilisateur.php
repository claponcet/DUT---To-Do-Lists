<?php


class ControleUtilisateur extends Controle
{

    function __construct(string $action)
    {
        global $chemin, $lesVues;

        try {
            switch ($action) {

                case "ALL_PRIV" :
                    $this->voirListesPriv($_SESSION['id']);
                    break;

                case "NEW_PRIV" :
                    $this->ajouterListePriv($_SESSION['id']);
                    break;

                case "DECONNEXION" :
                    $this->deconnexion();
                    break;

                default:
                    $this->tableauErreur[] = "Mauvais appel php";
                    require($chemin . $lesVues['erreur']);
                    break;
            }

        } catch (PDOException $e) {
            $this->tableauErreur[] = "Erreur de base de données";
            require($chemin . $lesVues['erreur']);

        } catch (Exception $e) {
            $this->tableauErreur[] = "Erreur inattendue";
            require($chemin . $lesVues['erreur']);
        }
        exit(0);
    }

    function voirListesPriv(int $id)
    {
        global $chemin, $lesVues;

        $tabListes=array();
        $id = Validation::val_int($id, $this->tableauErreur);

        $m = new ModeleDonnees();

        $nbPages = $m->getNbPagesPriv($id);

        $page = (isset($_GET['page'])) ? Validation::val_int($_GET['page'], $this->tableauErreur) : 1;
        $page = 0 ? 1 : $page; //si la page est à zéro, on la met à 1, sinon on la laisse

        if (!empty($this->tableauErreur)) {
            require($chemin . $lesVues['erreur']);
        }
        else
        {
            $tabListes=$m->getListesPrivees($id,$page);

            require($chemin . $lesVues['privee']);
        }
    }

    function ajouterListePriv(int $id)
    {
        global $chemin, $lesVues;

        // On récupère le titre dans le formulaire ou on l'initie à "" si rien n'a été rentré
        $titre = isset($_POST['titre']) ? $_POST['titre'] : "";

        Validation::val_titre($titre, $this->tableauErreur); //On valide le titre
        $id = Validation::val_int($id, $this->tableauErreur);

        if (!empty($this->tableauErreur)) {
            require($chemin . $lesVues['erreur']);
        } else {
            $m = new ModeleDonnees();
            $m->addPrivee($titre, $id);

            $this->voirListesPriv($id);
        }
    }

    function deconnexion()
    {
        unset($_SESSION['login']);
        unset($_SESSION['id']);

        $this->accueil();
    }
}