<?php
/**
 * Created by PhpStorm.
 * User: naashw
 * Date: 13/04/18
 * Time: 16:20
 */

namespace Controller;

use Model\testManager;
use Model\test;

class testController extends AbstractController
{


    public function test1()
    {

        $testManager = new testManager();
        $test1 = $testManager->findAll();
        var_dump($test1);

        return $this->twig->render('test/test1.html.twig', [ 'test1' => $test1 ]);
    }


}