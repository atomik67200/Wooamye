<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 */

namespace Controller;

use Model\Client;
use Model\ClientManager;

/**
 * Class ClientController
 * @package Controller
 */
class ClientController extends AbstractController
{

    /**
     * @return string
     */
    public function index()
    {
        if($_SERVER['REQUEST_METHOD']==='GET') {

            if ((isset($_GET['pseudo'])) && (strlen($_GET['pseudo']) >= 3) && (strlen($_GET['pseudo']) <= 6)) {
                session_start();
                $_SESSION['pseudo'] = $_GET['pseudo'];
                header("location:/decks");
            } else {
                $_SESSION['errorPseudo'] = "entre 3 à 6 caractères";
                return $this->twig->render('Client/index.html.twig', ['errorPseudo' => $_SESSION['errorPseudo']]);
            }
        }
    }
    public function decks()
    {
        //aller chercher les données via un manager
        //envoyer ces données à la vue
        session_start();
        $clientManager = new ClientManager();
        $listeDecks = $clientManager->findAll();
        $n = rand(0,3);
        $res = $listeDecks[$n];
        //print_r($listeDecks);
        return $this->twig->render('Client/decks.html.twig', ['res' => $res,'pseudo' => $_SESSION['pseudo']]);

    }

    public function play()
    {
        session_start();

        $clientManager = new Client();
        $Decks = $clientManager->findByCar();
        $tab=[];

        foreach($Decks as $key => $Decks) {
            $tab[] = $Decks['id_car'];
        }
        $_SESSION['$Personnage'] = $tab;
        $_SESSION['Random'] = $tab[rand(0,31)];


        if (isset($_SESSION['pseudo'])) {
            return $this->twig->render('Client/play.html.twig', ['pseudo' => $_SESSION['pseudo']]);
        }else
        {
            return $this->twig->render('Client/index.html.twig');
        }
    }

    public function elimination()
    {
        session_start();

        $_SESSION['Random']
        $_SESSION['$Personnage']


        foreach($Decks as $key => $Decks) {
            $tab[] = $Decks['id_car'];
        }
        $Personnage = $tab;
        $Random = $tab[rand(0,31)];
        var_dump ($Random);


        if (isset($_SESSION['pseudo'])) {
            return $this->twig->render('Client/play.html.twig', ['pseudo' => $_SESSION['pseudo']]);
        }else
        {
            return $this->twig->render('Client/index.html.twig');
        }
    }

    public function finDeParti()
    {
        session_start();
        if (isset($_SESSION['pseudo'])) {
            return $this->twig->render('Client/finDeParti.html.twig', ['pseudo' => $_SESSION['pseudo']]);
        }else
        {
            return $this->twig->render('Client/index.html.twig');
        }
    }
    /**
     * @param $id
     * @return string
     */
    public function show(int $id)
    {
        $clientManager = new ClientManager();
        $client = $clientManager->findOneById($id);

        return $this->twig->render('Client/show.html.twig', ['client' => $client]);
    }

    /**
     * @param $id
     * @return string
     */
    public function edit(int $id)
    {
        // TODO : edit client with id $id
        return $this->twig->render('Client/edit.html.twig', ['client', $id]);
    }

    /**
     * @param $id
     * @return string
     */
    public function add()
    {
        // TODO : add a new client
        return $this->twig->render('Client/add.html.twig');
    }

    /**
     * @param $id
     * @return string
     */
    public function delete(int $id)
    {
        // TODO : delete the client with id $id
        return $this->twig->render('Client/index.html.twig');
    }

    public function regles()
    {
        return $this->twig->render('Client/regles.html');
    }
}
