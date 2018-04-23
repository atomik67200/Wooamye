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
use Model\EntityManager;

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
    {   session_start();
        if($_SERVER['REQUEST_METHOD']==='GET') {
            unset($_SESSION['pseudo']);


            if ((!empty($_GET['pseudo'])) && (strlen($_GET['pseudo']) >= 3) && (strlen($_GET['pseudo']) <= 6)) {

                $_SESSION['pseudo'] = $_GET['pseudo'];
                header("location:/decks");
            } elseif ((!empty($_GET['pseudo'])) && (strlen($_GET['pseudo']) < 3) || (strlen($_GET['pseudo']) > 6))  {

                $_SESSION['errorPseudo'] = "entre 3 à 6 caractères";
                return $this->twig->render('Client/index.html.twig', ['errorPseudo' => $_SESSION['errorPseudo']]);
            }else {

                return $this->twig->render('Client/index.html.twig');
            }
        }
    }
    public function decks()
    {
        session_start();
        if (!empty($_SESSION['pseudo'])) {

            $clientManager = new ClientManager();
            $listeDecks = $clientManager->findByDecks('deck2');
            $n = rand(0, 31);
            $res = $listeDecks[$n];

            return $this->twig->render('Client/decks.html.twig', ['res' => $res, 'pseudo' => $_SESSION['pseudo']]);
        }else{
            header("location:/");
        }



    }

    public function play()
    {
        session_start();

        if (!empty($_SESSION['pseudo'])) {

        $clientManager = new Client();
        $Decks = $clientManager->findByCar();
        $tab=[];

        foreach($Decks as $key => $Decks) {
            $tab[] = $Decks['id_car'];
        }
        $_SESSION['Personnage'] = $tab;
        $_SESSION['Random'] = $tab[rand(0,31)];


            return header("location:/elimination");
        }else
        {
            return $this->twig->render('Client/index.html.twig');
        }
    }

    public function elimination()
    {
        session_start();
             if(!empty($_SESSION['pseudo'])) {
            $charManager = new ClientManager();
            $listChar = $charManager->findByDecks('deck2');


          //  $_SESSION['Personnage']
           // $_SESSION['Random']

            if (isset($_POST['image'])){
            foreach($_POST['image'] as $valeur)
            {

              unset($_SESSION['Personnage'][array_search($valeur , $_SESSION['Personnage'])]);
            }
            }
            var_dump($_SESSION['Random']);
            var_dump($_SESSION['Personnage']);

                 if (count($_SESSION['Personnage']) == 1){
                     header("location:/fin");
                 }else {
                     return $this->twig->render('Client/play.html.twig', ['pseudo' => $_SESSION['pseudo'],'listechar'=>$listChar]);
                 }


            }else {
                 return header("Location:/");
             }


    }


    public function finDeParti()
    {
        session_start();
        if (isset($_SESSION['pseudo'])) {


            var_dump(array_search($_SESSION['Random'] , $_SESSION['Personnage']));

            if ( (array_search($_SESSION['Random'] , $_SESSION['Personnage'])) !== FALSE ){
                $resultat = "Bien joué ! vous avez gagné";
            }elseif ( (array_search($_SESSION['Random'] , $_SESSION['Personnage'])) === FALSE ){
                $resultat = "Dommage vous avez perdu..";
            }

            return $this->twig->render('Client/finDeParti.html.twig', ['pseudo' => $_SESSION['pseudo'], 'resultat' => $resultat]);
        }else
        {
            return header("location:/");
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
