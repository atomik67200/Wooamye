<?php
/**
 * Created by PhpStorm.
 * User: wcs
 * Date: 23/10/17
 * Time: 10:57
 */


namespace Model;

/**
* Class Admin
* @package Model
*/
class Admin
{
private $id;

private $title;

private $picture;




/**
* @return mixed
*/
public function getId()
{
return $this->id;
}

/**
* @param mixed $id
* @return Admin
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
* @return Admin
*/
public function setTitle($title)
{
$this->title = $title;

return $this;
}



}
