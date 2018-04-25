<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 20:52
 */

namespace Model;


abstract class EntityManager
{
    protected $conn; //variable de connexion

    protected $table;

    public function __construct($table)
    {
        $db = new Connection();
        $this->conn = $db->getPdo();
        $this->table = $table;
    }

    /**
     * @return array
     */

    public function findAll()
    {
        return $this->conn->query('SELECT * FROM ' . $this->table, \PDO::FETCH_ASSOC)->fetchAll();
    }

    /**
     * @param $id
     * @return array
     */
    public function findOneById( $id)
    {
        // prepared request
        $statement = $this->conn->prepare("SELECT * FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function findByDecks($param)
    {
        // prepared request
        $statement = $this->conn->prepare("SELECT * FROM $this->table WHERE decks=:param");
        $statement->bindValue('param', $param, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }



    /**
     *
     */
    public function delete($id)
    {
        //TODO : Implements SQL DELETE request
    }

    /**
     *
     */
     public function insert($decks, $image, $idcar)
     {

         $statement = $this->conn->prepare("INSERT INTO Decks(decks, image, id_car) VALUES (:decks,:image,:id_car);");
         $statement->bindValue(':decks', $decks, \PDO::PARAM_STR);
         $statement->bindValue(':image', $image, \PDO::PARAM_STR);
         $statement->bindValue(':id_car', $idcar, \PDO::PARAM_INT);
         $statement->execute();
     }


    /**
     *
     */
    public function update($id, $data)
    {
        //TODO : Implements SQL UPDATE request
    }


}
