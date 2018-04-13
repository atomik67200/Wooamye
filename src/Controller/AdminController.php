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

}
