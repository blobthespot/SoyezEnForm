<?php

namespace FormGenerator\FormBundle\Entity;
class Formulaire
{
    private $question;
    private $reponses;
    private $indexReponse;

    public function getIndexReponse()
    {
        return $this->indexReponse;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function getReponses()
    {
        return $this->reponses;
    }

    public function setIndexReponse($indexReponse)
    {
        $this->indexReponse = $indexReponse;
    }

    public function setQuestion($question)
    {
        $this->question = $question;
    }

    public function setReponses($reponses)
    {
        $this->reponses = $reponses;
    }

    public function checkReponse($rep){
        if (is_numeric($rep)){
            if ($rep == $this->indexReponse)
                return true;
        }
        else return false;
    }
}