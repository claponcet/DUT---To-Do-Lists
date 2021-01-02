<?php


class ControleVisiteur extends Controle
{

    function __construct(?string $action)
    {
        global $chemin, $lesVues;

        try {
            switch ($action) {

                case NULL:
                    $this->accueil(); //appeler page d'accueil via la classe mère
                    break;

                case "VOIR_LISTE" : //visualiser une liste avec ses tâches
                    $this->voirListe($_REQUEST['idliste']);
                    break;

                case "ADD_LISTE_PUB": //ajouter une liste publique
                    $this->ajouterListePub();
                    break;

                case "SUP_LISTE": //supprimer une liste
                    $this->supprimerListe($_REQUEST['idliste']);
                    break;

                case "CHECK_TACHE": //changer l'état 'effectuée' d'une tâche
                    $this->checkTache($_REQUEST['idTache'], $_REQUEST['idliste']);
                    break;

                case "ADD_TACHE": //ajouter une tâche
                    $this->ajouterTache($_REQUEST['idliste']);
                    break;

                case "SUP_TACHE": //supprimer une tâche
                    $this->supprimerTache($_REQUEST['idTache'], $_REQUEST['idliste']);
                    break;

                case "FORM_CO": //accéder au formulaire de connexion
                    $this->affichageConnexion();
                    break;

                case "CONNEXION": //valider le formulaire de connexion
                    $this->connexion();
                    break;

                case "FORM_INS":
                    $this->affichageInscription();
                    break;

                case "INSCRIPTION":
                    $this->inscription();
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

    function voirListe(int $id)
    {
        global $chemin, $lesVues;

        $m = new ModeleDonnees();
        $titre = $m->getTitre($id);
        $tabTaches = $m->getTache($id);

        require($chemin . $lesVues['uneListe']);
    }


    function ajouterListePub()
    {
        global $chemin, $lesVues;

        // On récupère le titre dans le formulaire ou on l'initie à "" si rien n'a été rentré
        $titre = isset($_POST['titre']) ? $_POST['titre'] : "";

        Validation::val_titre($titre, $this->tableauErreur); //On valide le titre

        if (!empty($this->tableauErreur)) {
            require($chemin . $lesVues['erreur']);
        } else {
            $m = new ModeleDonnees();
            $m->addPublique($titre);

            $this->accueil();
        }
    }

    function supprimerListe(int $id)
    {
        global $chemin, $lesVues;

        $id = Validation::val_int($id, $this->tableauErreur);

        if (!empty($this->tableauErreur)) {
            require($chemin . $lesVues['erreur']);
        }

        $m = new ModeleDonnees();
        $m->deleteListe($id);

        $this->accueil();
    }

    function ajouterTache(int $id)
    {
        global $chemin, $lesVues;

        $intitule = isset($_POST['intitule']) ? $_POST['intitule'] : "";
        Validation::val_tache($intitule, $this->tableauErreur);

        $id = Validation::val_int($id, $this->tableauErreur);

        if (!empty($this->tableauErreur)) {
            require($chemin . $lesVues['erreur']);
        } else {
            $m = new ModeleDonnees();
            $m->addTache($intitule,$id);

            $this->voirListe($id);
        }
    }

    function checkTache(int $idT, int $idL)
    {
        global $chemin, $lesVues;

        $idT = Validation::val_int($idT, $this->tableauErreur);
        $idL = Validation::val_int($idL, $this->tableauErreur);

        if (!empty($this->tableauErreur)) {
            require($chemin . $lesVues['erreur']);
        }
        else
        {
            $m = new ModeleDonnees();
            $t = $m->getById($idT);

            if ($t->isEffectuee())
            {
                $m->uncheckTache($idT);
            }
            else
            {
                $m->checkTache($idT);
            }

            $this->voirListe($idL);
        }
    }

    function supprimerTache(int $idT, int $idL)
    {
        global $chemin, $lesVues;

        $idT = Validation::val_int($idT, $this->tableauErreur);
        $idL = Validation::val_int($idL, $this->tableauErreur);

        if (!empty($this->tableauErreur)) {
            require($chemin . $lesVues['erreur']);
        }
        else
        {
            $m = new ModeleDonnees();
            $m->deleteTache($idT);

            $this->voirListe($idL);
        }
    }

    function affichageConnexion()
    {
        global $chemin, $lesVues;

        require($chemin . $lesVues['connexion']);
    }

    function connexion()
    {
        global $chemin, $lesVues;

        $login=$_POST['login'];
        $mdp=$_POST['mdp'];

        $login=Validation::val_login($login,$this->tableauErreur);
        $mdp=Validation::val_mdp($mdp,$this->tableauErreur);

        if (!empty($this->tableauErreur) || !isset($login) || !isset($mdp)) {
            require($chemin . $lesVues['erreur']);
        }
        else {
            $m=new ModeleUtilisateur();
            $user=$m->connexion($login, $mdp);

            if (isset($user)) {
                $this->accueil();
            }
            else {
                $this->tableauErreur[]='Erreur de connexion';
                require($chemin . $lesVues['erreur']);
                require($chemin . $lesVues['connexion']);
            }
        }
    }

    function affichageInscription()
    {
        global $chemin, $lesVues;

        require($chemin . $lesVues['inscription']);
    }

    function inscription()
    {
        global $chemin, $lesVues;

        $login=$_POST['login'];
        $mdp=$_POST['mdp'];

        $login=Validation::val_login($login,$this->tableauErreur);
        $mdp=Validation::val_mdp($mdp,$this->tableauErreur);

        if (!empty($this->tableauErreur) || !isset($login) || !isset($mdp)) {
            require($chemin . $lesVues['erreur']);
        }
        else {
            $m=new ModeleUtilisateur();
            if($m->inscription($login, $mdp)) {
                $this->accueil();
            }
            else {
                $this->tableauErreur[]="Erreur : login déjà utilisé";
                require($chemin . $lesVues['erreur']);
                require($chemin . $lesVues['inscription']);
            }
        }
    }
}