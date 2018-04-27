<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 */

namespace Model;


class AdminManager extends EntityManager
{
    const TABLE = 'Decks';


    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
    public function delete($nomDeck)
    {
        $statement = $this->conn->prepare("DELETE  FROM $this->table WHERE decks = :nomDeck");
        $statement->bindValue('nomDeck', $nomDeck, \PDO::PARAM_INT);


        return $statement->execute();
    }
}
