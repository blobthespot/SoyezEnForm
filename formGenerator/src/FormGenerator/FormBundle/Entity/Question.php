<?php

namespace FormGenerator\FormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="FormGenerator\FormBundle\Repository\QuestionRepository")
 */
class Question
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
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @ORM\ManyToOne(targetEntity="Topic")
     * @ORM\JoinColumn(name="topic_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $topic;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="is_multiple", type="boolean")
     */
    private $isMultiple;

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question",cascade={"persist"}, orphanRemoval=true, fetch="EAGER")
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question")
     */
    private $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @param mixed $answers
     */
    public function setAnswers($answers)
    {
        $this->answers = $answers;
    }

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
     * Set question
     *
     * @param string $question
     *
     * @return Question
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set topicId
     *
     * @param integer $topicId
     *
     * @return Question
     */
    public function setTopicId($topicId)
    {
        $this->topicId = $topicId;

        return $this;
    }

    /**
     * Get topicId
     *
     * @return int
     */
    public function getTopicId()
    {
        return $this->topicId;
    }

    /**
     * Set isMultiple
     *
     * @param boolean $isMultiple
     *
     * @return Question
     */
    public function setIsMultiple($isMultiple)
    {
        $this->isMultiple = $isMultiple;

        return $this;
    }

    /**
     * Get isMultiple
     *
     * @return bool
     */
    public function getIsMultiple()
    {
        return $this->isMultiple;
    }

    /**
     * Add answer
     *
     * @param \FormGenerator\FormBundle\Entity\Answer $answer
     *
     * @return Question
     */
    public function addAnswer(\FormGenerator\FormBundle\Entity\Answer $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \FormGenerator\FormBundle\Entity\Answer $answer
     */
    public function removeAnswer(\FormGenerator\FormBundle\Entity\Answer $answer)
    {
        $this->answers->removeElement($answer);
    }

    /**
     * Set topic
     *
     * @param \FormGenerator\FormBundle\Entity\Topic $topic
     *
     * @return Question
     */
    public function setTopic(\FormGenerator\FormBundle\Entity\Topic $topic = null)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return \FormGenerator\FormBundle\Entity\Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }
}
