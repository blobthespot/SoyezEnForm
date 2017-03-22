<?php

namespace FormGenerator\FormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Answer
 *
 * @ORM\Table(name="answer")
 * @ORM\Entity(repositoryClass="FormGenerator\FormBundle\Repository\AnswerRepository")
 */
class Answer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
<<<<<<< HEAD
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", onDelete="CASCADE")
=======
     * @var int
     *
     * @ORM\Column(name="question_id", type="integer", unique=false)
>>>>>>> remotes/origin/VictorJPP
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="answer", type="text")
     */
    private $answer;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_correct", type="boolean")
     */
    private $isCorrect;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set answer
     *
     * @param string $answer
     *
     * @return Answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set isCorrect
     *
     * @param boolean $isCorrect
     *
     * @return Answer
     */
    public function setIsCorrect($isCorrect)
    {
        $this->isCorrect = $isCorrect;

        return $this;
    }

    /**
     * Get isCorrect
     *
     * @return bool
     */
    public function getIsCorrect()
    {
        return $this->isCorrect;
    }

    /**
     * Set question
     *
     * @param \FormGenerator\FormBundle\Entity\Question $question
     *
     * @return Answer
     */
    public function setQuestion(\FormGenerator\FormBundle\Entity\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \FormGenerator\FormBundle\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
