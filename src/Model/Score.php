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
class Score extends ScoreManager
{
    private $pseudo;
    private $score;


    public function uploadScore($pseudo, $score)
    {
        $statement = $this->conn->prepare("INSERT INTO Score(pseudo, score) VALUES (:pseudo,:score);");
        $statement->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
        $statement->bindValue(':score', $score, \PDO::PARAM_STR);
        $statement->execute();


    }

    public function downloadScore()
    {
        return $this->conn->query("SELECT * FROM Score  ORDER BY score DESC LIMIT 10", \PDO::FETCH_ASSOC)->fetchAll();


    }

    public function findByPseudo($param)
    {
        $statement = $this->conn->prepare("SELECT * FROM $this->table WHERE pseudo = :pseudo");
        $statement->bindValue(':pseudo', $param, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

}