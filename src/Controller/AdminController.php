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
        if ($_SERVER["REQUEST_METHOD"] === "POST")
            {
            header('/wshmagl');
            } else {

                echo 'wshmagl';
            return $this->twig->render('Admin/index.html.twig');
            }
    }

    public function ajouter()
    {
        return $this->twig->render('Admin/ajouter.html.twig');
    }

}
