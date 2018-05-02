<?php

namespace Controller;

use Model\Admin;
use Model\AdminManager;
use Model\CarManager;

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 15:38
 */
class AdminController extends AbstractController
{
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */

    /*public function index()
    {
        return $this->twig->render('Admin/index.html.twig');

    }*/

    public function Verif()
    {


        return $this->twig->render('Admin/index.html.twig');
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function ajouter()
    {
        if ((($_POST['login'] === 'olivier') && ($_POST['password'] === 'franck'))  || (!isset($_SESSION['login'])))
        {
            session_start();
            $_SESSION['login'] = $_POST['login'];
            return $this->twig->render('Admin/ajouter.html.twig', ['login' => $_SESSION['login']]);
        }elseif(isset($_SESSION['login'])){
            return $this->twig->render('Admin/ajouter.html.twig');
        }
        else{
            header('location : /admin');
        }
    }
    public function redirection()
    {
        if (isset($_POST['selectAA'])){
            if($_POST['selectAA']==='modifier'){

                return header("location:/modifier");

            }elseif($_POST['selectAA']==='supprimer'){

                return header("location:/supprimer");

            }elseif ($_POST['selectAA']==='ajouter'){
                return header("location:/ajouter");

            }


            //var_dump($_POST);

        }
    }

    public function modifier()
    {
        session_start();
        $charManager = new AdminManager();
        //$listChar = $charManager->findByDecks('SouthPark2');
        $carManager = new CarManager();
        $car = $carManager->findAll();
        $personnages = [];
        if ((isset($_GET['selectAA'])) && (!empty($_GET['selectAA']))) {
            //var_dump($_GET['selectAA']);
            $_SESSION['deckmodif'] = $_GET['selectAA'];
            $listChar = $charManager->findByDecks($_GET['selectAA']);
            foreach ($listChar as $char) {
                $personnages[$char['id_car']] = ['ID' => $char['ID'], 'decks' => $char['decks'], 'image' => $char['image'], 'cars' => $car[$char['id_car'] - 1]];
            }
        }else {
            $listChar = $charManager->findByDecks('NewDeck');
            foreach ($listChar as $char) {
                $personnages[$char['id_car']] = ['ID' => $char['ID'], 'decks' => $char['decks'], 'image' => $char['image'], 'cars' => $car[$char['id_car'] - 1]];
            }
        }

        $allDeck = $charManager->findRandomForAllDecks();

        return $this->twig->render('Admin/modifier.html.twig', ['dekk' => $_GET['selectAA'],'allDeck' => $allDeck, 'car' => $car, 'personnages' => $personnages]);
    }
// 'listechar' => $listChar
    public function supprimer()
    {
        session_start();




        if(isset($_POST['supprDeck']))
        {
            if ( $_POST['supprDeck'] != "NewDeck" ) {
                $delManager = new AdminManager();
                $delManager->delete($_POST['supprDeck']);
            }
            else{
                $erreur = 'Vous ne pouvez pas supprimer le set de base.';

            }
        }

        $adminManager = new AdminManager;
        $resultat =  $adminManager->findRandomForAllDecks();

        return $this->twig->render('Admin/supprimer.html.twig', ['resultat' => $resultat, 'erreur'=>$erreur,'login' => $_SESSION['login']]);
    }

    public function changerAccueil()
    {


        if (isset($_POST["contenu"]))
        {
            $fichier = "../src/View/Client/regles.html";
            $file = fopen($fichier, 'w');
            fwrite($file,($_POST["contenu"]));
            fclose($file);
        }


        $dir=opendir("../src/View/Client/");
        while($allFile = readdir($dir)) {
            if (in_array($allFile, array("regles.html"))) {
                echo '<a href="?f=' . $allFile . '">';
                echo $allFile;
                echo '</a>';
            }
        }

        if (isset($_GET["f"])) {
            $fichier = "../src/View/Client/". $_GET["f"];
            $contenu = file_get_contents($fichier);
            return $this->twig->render('Admin/changerAccueil.html.twig',['contenu'=>$contenu],['fichier'=>$fichier]);
        }
        return $this->twig->render('Admin/changerAccueil.html.twig');

    }




}
