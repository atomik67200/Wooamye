<?php
/**
 * Created by PhpStorm.
 * User: naashw
 * Date: 23/04/18
 * Time: 13:48
 */

namespace Model;



class CarManager extends EntityManager
{

    const TABLE = 'caracteristique';


    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


}