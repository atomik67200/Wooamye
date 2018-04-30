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


    public function findRandomForAllDecks()
    {
        $tousLesDecks = $this->findAllDeckName();
        //var_dump($tousLesDecks);
        $resultat = [];
        foreach ($tousLesDecks as $unDeck) {
            $resultat[] = $this->findRandomByDecks($unDeck['decks']);
        }

        return $resultat;

    }
}
