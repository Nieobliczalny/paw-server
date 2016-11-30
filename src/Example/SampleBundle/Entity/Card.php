<?php
// src\Example\SampleBundle\Entity\Card.php
namespace Example\SampleBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Example\SampleBundle\Entity\CardList;
use Doctrine\Common\Collections\ArrayCollection;


 /**
  * @ORM\Entity
  * @ORM\Table(name="Card")
  */
class Card
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="CardList", inversedBy="cards")
     * @ORM\JoinColumn(name="cardList_id", referencedColumnName="id")
     */
    private $cardList;

    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="card")
     */
    protected $tasks;

    /**
     * @ORM\Column(type="boolean", length=150)
     */
    protected $archived;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $description;

    /**
     * @ORM\Column(type="integer")
     */
    protected $position;

    /**
     * @ORM\Column(type="date")
     */
    protected $date;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="card", cascade={"remove"})
     */
    protected $comments;

    /**
     * @ORM\ManyToMany(targetEntity="Tag")
     */
    protected $tags;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Card
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set archived
     *
     * @param boolean $archived
     *
     * @return Card
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;
    
        return $this;
    }

    /**
     * Get archived
     *
     * @return boolean
     */
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Card
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return Card
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set cardList
     *
     * @param \Example\SampleBundle\Entity\CardList $cardList
     *
     * @return Card
     */
    public function setCardList(\Example\SampleBundle\Entity\CardList $cardList = null)
    {
        $this->cardList = $cardList;
    
        return $this;
    }

    /**
     * Get cardList
     *
     * @return \Example\SampleBundle\Entity\CardList
     */
    public function getCardList()
    {
        return $this->cardList;
    }

    /**
     * Add task
     *
     * @param \Example\SampleBundle\Entity\Task $task
     *
     * @return Card
     */
    public function addTask(\Example\SampleBundle\Entity\Task $task)
    {
        $this->tasks[] = $task;
    
        return $this;
    }

    /**
     * Remove task
     *
     * @param \Example\SampleBundle\Entity\Task $task
     */
    public function removeTask(\Example\SampleBundle\Entity\Task $task)
    {
        $this->tasks->removeElement($task);
    }

    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * Add comment
     *
     * @param \Example\SampleBundle\Entity\Comment $comment
     *
     * @return Card
     */
    public function addComment(\Example\SampleBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;
    
        return $this;
    }

    /**
     * Remove comment
     *
     * @param \Example\SampleBundle\Entity\Comment $comment
     */
    public function removeComment(\Example\SampleBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add tag
     *
     * @param \Example\SampleBundle\Entity\Tag $tag
     *
     * @return Card
     */
    public function addTag(\Example\SampleBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;
    
        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Example\SampleBundle\Entity\Tag $tag
     */
    public function removeTag(\Example\SampleBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
        return $tag;
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Card
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
