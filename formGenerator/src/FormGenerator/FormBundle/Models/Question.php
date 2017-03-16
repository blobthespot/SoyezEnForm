<?php
/**
 * Created by PhpStorm.
 * User: Benoit
 * Date: 16/03/2017
 * Time: 14:54
 */

namespace FormGenerator\FormBundle\Models;


class Question
{
    private $Question;
    private $Responses;

    /**
     * @return array
     */
    public function getResponses()
    {
        return $this->Responses;
    }

    /**
     * @param array $Responses
     */
    public function setResponses($Responses)
    {
        $this->Responses = $Responses;
    }

    function __construct()
    {
        $this->Question = "";
        $this->Responses = [];
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->Question;
    }

    /**
     * @param mixed $Question
     */
    public function setQuestion($Question)
    {
        $this->Question = $Question;
    }



}