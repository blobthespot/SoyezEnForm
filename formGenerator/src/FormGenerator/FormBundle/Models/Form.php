<?php
/**
 * Created by PhpStorm.
 * User: Benoit
 * Date: 16/03/2017
 * Time: 14:52
 */

namespace FormGenerator\FormBundle\Models;


class Form
{
    private  $Name;
    private $Questions;

    function __construct(){
        $this->Name = "";
        $this->Questions = [];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param string $Name
     */
    public function setName($Name)
    {
        $this->Name = $Name;
    }

    /**
     * @return array
     */
    public function getQuestions()
    {
        return $this->Questions;
    }

    /**
     * @param array $Questions
     */
    public function setQuestions($Questions)
    {
        $this->Questions = $Questions;
    }

}