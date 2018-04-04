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
        $clientManager = new ClientManager();
        $clients = $clientManager->findAll();

        return $this->twig->render('Client/index.html.twig');
    }

    public function decks()
    {
        $clientManager = new ClientManager();
        $clients = $clientManager->findAll();

        return $this->twig->render('Client/decks.html.twig');
    }

    public function play()
    {
        $clientManager = new ClientManager();
        $clients = $clientManager->findAll();

        return $this->twig->render('Client/play.html.twig');
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
}
