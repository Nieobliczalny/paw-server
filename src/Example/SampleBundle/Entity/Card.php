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



    public function __construct()
    {
        $this->tasks = new ArrayCollection();
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
}
