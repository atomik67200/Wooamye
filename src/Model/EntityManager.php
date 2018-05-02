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

    public function findOneByIdcar( $id, $deck)
    {
        // prepared request
        $statement = $this->conn->prepare("SELECT * FROM $this->table WHERE id_car=:id AND decks=:deck");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->bindValue('deck', $deck, \PDO::PARAM_INT);
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

    public function findRandomByDecks($param)
    {
        // prepared request
        $statement = $this->conn->prepare("SELECT * FROM $this->table WHERE decks=:param");
        $statement->bindValue('param', $param, \PDO::PARAM_STR);
        $statement->execute();
        $n = rand(0,31);
        return $statement->fetchAll(\PDO::FETCH_ASSOC)[$n];
    }

    public function findAllDeckName()
    {
        $statement = $this->conn->query("SELECT DISTINCT decks FROM $this->table");
        return $statement->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function findRandomForAllDecks()
    {
        $tousLesDecks = $this->findAllDeckName();
        //var_dump($tousLesDecks);
        $resultat=[];
        foreach ($tousLesDecks as $unDeck)
        {
            $resultat[]=$this->findRandomByDecks($unDeck['decks']);
        }

        return $resultat;

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
    public function updateImg($data , $idcar, $nom)
    {
        $statement = $this->conn->prepare("UPDATE Decks SET image =:dta WHERE id_car=:car AND decks =:nom ;");

        $statement->bindValue(':dta', $data, \PDO::PARAM_STR);
        $statement->bindValue(':car', $idcar, \PDO::PARAM_STR);
        $statement->bindValue(':nom', $nom, \PDO::PARAM_STR);

        $statement->execute();
    }


}
