<?php
/**
 * Created by PhpStorm.
 * User: wcs
 * Date: 23/10/17
 * Time: 10:57
 */

namespace Model;

/**
 * Class Client
 * @package Model
 */
class Client extends ClientManager
{
    private $id;

    private $title;






    public function findByCar()
    {
        // prepared request
       return $statement = $this->conn->query("SELECT id_car FROM $this->table WHERE decks='Decks2'", \PDO::FETCH_ASSOC)->fetchAll();
       // foreach ($car as $key => $value)
    }

    

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Client
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Client
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }



}
