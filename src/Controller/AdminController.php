<?php

namespace Controller;

use Model\Admin;
use Model\AdminManager;

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
            if($_POST['selectAA']==='Modifier un set'){

                return $this->twig->render('Admin/modifier.html.twig');
            }elseif($_POST['selectAA']==='Supprimer un set'){

                return $this->twig->render('Admin/supprimer.html.twig');
            }elseif ($_POST['selectAA']==='Ajouter un set'){
                return $this->twig->render('Admin/ajouter.html.twig');
            }


            //var_dump($_POST);

        }
    }


        public function modifier()
    {
        session_start();
        return $this->twig->render('Admin/modifier.html.twig', ['login' => $_SESSION['login']]);
    }

    public function supprimer()
    {
        session_start();
        $adminManager = new AdminManager;
        $listeDecks = $adminManager->findAll();
        $n = rand(0,31);
        $res = $listeDecks[$n];
        var_dump($res);

        return $this->twig->render('Admin/supprimer.html.twig', ['res' => $res,'login' => $_SESSION['login']]);
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

        if (isset($_POST["f"])) {

            $fichier = "../src/View/Client/". $_POST["f"];
            $contenu = file_get_contents($fichier);
            return $this->twig->render('Admin/changerAccueil.html.twig',['contenu'=>$contenu],['fichier'=>$fichier]);
        }
        return $this->twig->render('Admin/changerAccueil.html.twig');

    }




}
