<?php
/**
 * Created by PhpStorm.
 * User: Benoit
 * Date: 16/03/2017
 * Time: 15:04
 */

namespace FormGenerator\FormBundle\Models;


class Reponse
{
    public $Reponse;
    public $isValid;

    function __construct()
    {
        $this->Reponse = "";
        $this->isValid = false;
    }

    /**
     * @return string
     */
    public function getReponse()
    {
        return $this->Reponse;
    }

    /**
     * @param string $Reponse
     */
    public function setReponse($Reponse)
    {
        $this->Reponse = $Reponse;
    }

    /**
     * @return bool
     */
    public function isIsValid()
    {
        return $this->isValid;
    }

    /**
     * @param bool $isValid
     */
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;
    }
}