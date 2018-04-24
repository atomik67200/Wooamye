<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 */

namespace Controller;

use Model\CarManager;
use Model\Client;
use Model\ClientManager;
use Model\ScoreManager;
use Model\Score;


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
            $_SESSION['reponse'] = NULL;
            $_SESSION['score'] = 100;

            $carManager = new CarManager();
            $_SESSION['car'] = $carManager->findOneById($_SESSION['Random']);


            return header("location:/elimination");
        }else
        {
            return header("location:/");
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

            if (isset($_POST['button'])){
                if ($_POST['button'] == "question"){

                    if (isset($_POST['option'])){
                        switch ($_POST['option'])
                        {
                            case "barbe":
                                $reponse = "Le personnage a t'il une barbe ? : ".$_SESSION['car'][$_POST['option']];
                                $_SESSION['score'] -= 20;
                                break;

                            case "chapeau":
                                $reponse = "Le personnage a t'il un chapeau ? : ".$_SESSION['car'][$_POST['option']];
                                $_SESSION['score'] -= 20;
                                break;

                            case "lunette":
                                $reponse = "Le personnage a t'il des lunettes ? : ".$_SESSION['car'][$_POST['option']];
                                $_SESSION['score'] -= 20;
                                break;

                            case "ral":
                                $reponse = "Le personnage a t'il du rouge à lèvres ? : ".$_SESSION['car'][$_POST['option']];
                                $_SESSION['score'] -= 20;
                                break;
                            case "cheveuxBrun":
                                if ($_SESSION['car']['cheveux'] == 'oui') {
                                    $reponse = "Le personnage a t'il des cheveux brun ? : oui";
                                }elseif ($_SESSION['car']['cheveux'] == 'non') {
                                    $reponse = "Le personnage a t'il des cheveux brun ? : non";
                                }
                                $_SESSION['score'] -= 20;
                                break;

                            case "cheveuxBlond":
                                if ($_SESSION['car']['cheveux'] == 'non') {
                                    $reponse = "Le personnage a t'il des cheveux blond ? : oui";
                                }elseif ($_SESSION['car']['cheveux'] == 'oui') {
                                    $reponse = "Le personnage a t'il des cheveux blond ? : non";
                                }
                                $_SESSION['score'] -= 20;
                                break;

                            case "genreHomme":
                                if ($_SESSION['car']['genre'] == 'homme') {
                                    $reponse = "Le personnage est un homme ? : oui";
                                }elseif ($_SESSION['car']['genre'] == 'femme') {
                                    $reponse = "Le personnage est un homme ? : non";
                                }
                                $_SESSION['score'] -= 20;
                                break;

                            case "genreFemme":
                                if ($_SESSION['car']['genre'] == 'femme') {
                                    $reponse = "Le personnage est un femme ? : oui";
                                }elseif ($_SESSION['car']['cheveux'] == 'homme') {
                                    $reponse = "Le personnage est un femme ? : non";
                                }
                                $_SESSION['score'] -= 20;
                                break;
                        }
                        var_dump($_SESSION['Personnage']);
                        //  $reponse = $_SESSION['car'][$_POST['option']];

                        //  $allReponse[] = $reponse;
                        if (empty($_SESSION['reponse'])){
                            $_SESSION['reponse'][] = $reponse;
                        }elseif (!empty($_SESSION['reponse'])){
                            array_unshift($_SESSION['reponse'], $reponse);
                        }


                    }
                }

                if ($_POST['button'] == "eliminer") {

                    if (isset($_POST['image'])) {
                        foreach ($_POST['image'] as $valeur) {

                            unset($_SESSION['Personnage'][array_search($valeur, $_SESSION['Personnage'])]);
                        }
                    }
                }



            }




            if (isset($_POST['button'])){
                if($_POST['button'] == "valider"){
                    if (count($_POST['image']) == 1 ){
                        $_SESSION['Personnage'] = $_POST['image'];
                        header("location:/score");
                    }
                }
            }

            if (count($_SESSION['Personnage']) == 1){
                header("location:/score");
            }else {
                return $this->twig->render('Client/play.html.twig', ['score'=> $_SESSION['score'], 'pseudo' => $_SESSION['pseudo'],'listechar'=>$listChar , 'reponse' => $_SESSION['reponse']]);
            }




        }else {
            return header("Location:/");
        }


    }



    public function finDeParti()
    {
        session_start();
        $charManager = new ClientManager();
        $listChar = $charManager->findByDecks('deck2');
        $listChar[$_SESSION['Random']];

        if (isset($_SESSION['pseudo'])) {


            if ( (array_search($_SESSION['Random'] , $_SESSION['Personnage'])) !== FALSE ){
                $resultat = "Bien joué ! vous avez gagné";
            }elseif ( (array_search($_SESSION['Random'] , $_SESSION['Personnage'])) === FALSE ){
                $resultat = "Dommage vous avez perdu..";
            }



            return $this->twig->render('Client/finDeParti.html.twig', ['perso'=> $listChar,'score' => $_SESSION['score'], 'pseudo' => $_SESSION['pseudo'], 'resultat' => $resultat]);
        }else
        {
            return header("location:/");
        }
    }

    public function Score()
    {
        session_start();
        if (isset($_SESSION['pseudo'])) {
            if ( (array_search($_SESSION['Random'] , $_SESSION['Personnage'])) !== FALSE ) {
                $pseudo = $_SESSION['pseudo'];
                $Score = new Score();
               // $pseudoExist = $Score->findByPseudo($pseudo);
                $Score->uploadScore($pseudo, $_SESSION['score']);
            }
            return header("location:/fin");
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
