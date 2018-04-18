<?php

namespace Controller;

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
    public function index()
    {
        return $this->twig->render('Admin/index.html.twig');
    }

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
        if(($_POST['pseudo']==='olivier')&&($_POST['password']==='franck'))
           {
                return $this->twig->render('Admin/ajouter.html.twig');
            }else{
                return $this->twig->render('Admin/index.html.twig');
            }

        //return $this->twig->render('Admin/ajouter.html.twig');
    }

    public function modifier()
    {
        return $this->twig->render('Admin/modifier.html.twig');
    }

    public function supprimer()
    {
        return $this->twig->render('Admin/supprimer.html.twig');
    }

    public function changerAccueil()
    {
        if (isset($_POST["contenu"]))
        {
            $fichier = "../src/View/Client/index.html.twig";
            $file = fopen($fichier, 'w');
            fwrite($file,($_POST["contenu"]));
            fclose($file);
        }

        $dir=opendir("../src/View/Client/");
        while($allFile = readdir($dir)) {
            if (in_array($allFile, array("index.html.twig"))) {
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
        header('Admin/changerAccueil.html.twig');



    }




}
