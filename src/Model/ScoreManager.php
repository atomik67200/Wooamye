<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 */

namespace Model;


class  ScoreManager extends EntityManager
{
    const TABLE = 'Score';


    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /*public function getDecksWithOneRandomImage()
    {
        return $this->conn->query('SELECT FROM', \PDO::FETCH_ASSOC)->fetchAll();
    }*/


}
