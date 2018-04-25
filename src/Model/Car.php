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
class car
{
    private $ID;
    private $genre;
    private $lunette;
    private $barbe;
    private $cheveux;
    private $chapeau;
    private $ral;

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getLunette()
    {
        return $this->lunette;
    }

    /**
     * @param mixed $lunette
     */
    public function setLunette($lunette)
    {
        $this->lunette = $lunette;
    }

    /**
     * @return mixed
     */
    public function getBarbe()
    {
        return $this->barbe;
    }

    /**
     * @param mixed $barbe
     */
    public function setBarbe($barbe)
    {
        $this->barbe = $barbe;
    }

    /**
     * @return mixed
     */
    public function getCheveux()
    {
        return $this->cheveux;
    }

    /**
     * @param mixed $cheveux
     */
    public function setCheveux($cheveux)
    {
        $this->cheveux = $cheveux;
    }

    /**
     * @return mixed
     */
    public function getChapeau()
    {
        return $this->chapeau;
    }

    /**
     * @param mixed $chapeau
     */
    public function setChapeau($chapeau)
    {
        $this->chapeau = $chapeau;
    }

    /**
     * @return mixed
     */
    public function getRal()
    {
        return $this->ral;
    }

    /**
     * @param mixed $ral
     */
    public function setRal($ral)
    {
        $this->ral = $ral;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->ID;
    }

    /**
     * @param mixed $id
     * @return Client
     */
    public function setId($ID)
    {
        $this->ID = $ID;

        return $this;
    }





}
