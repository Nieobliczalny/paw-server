<?php
// src\Example\SampleBundle\Entity\Task.php
namespace Example\SampleBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

 /**
  * @ORM\Entity
  * @ORM\Table(name="Task")
  */
class Task
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
     * @ORM\Column(type="text", length=100)
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="Card", inversedBy="tasks")
     * @ORM\JoinColumn(name="card_id", referencedColumnName="id")
     */
    private $card;



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
     * @return Task
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
     * Set description
     *
     * @param string $description
     *
     * @return Task
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
     * Set card
     *
     * @param \Example\SampleBundle\Entity\Card $card
     *
     * @return Task
     */
    public function setCard(\Example\SampleBundle\Entity\Card $card = null)
    {
        $this->card = $card;
    
        return $this;
    }

    /**
     * Get card
     *
     * @return \Example\SampleBundle\Entity\Card
     */
    public function getCard()
    {
        return $this->card;
    }
}
