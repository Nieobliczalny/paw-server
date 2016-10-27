<?php
// src\Example\SampleBundle\Entity\CardList.php
namespace Example\SampleBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Example\SampleBundle\Entity\Board;
use Doctrine\Common\Collections\ArrayCollection;


 /**
  * @ORM\Entity
  * @ORM\Table(name="CardList")
  */
class CardList
{
	/**
      * @ORM\Id
      * @ORM\Column(type="integer")
      * @ORM\GeneratedValue(strategy="AUTO")
      */
	protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Board", inversedBy="cardList")
     * @ORM\JoinColumn(name="board_id", referencedColumnName="id")
     */
    private $board;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Card", mappedBy="cardList")
     */
    protected $cards;

    /**
     * @ORM\Column(type="boolean", length=150)
     */
    protected $archived;



    public function __construct()
    {
        $this->cards = new ArrayCollection();
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
     * @return CardList
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
     * @return CardList
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
     * Set board
     *
     * @param \Example\SampleBundle\Entity\Board $board
     *
     * @return CardList
     */
    public function setBoard(\Example\SampleBundle\Entity\Board $board = null)
    {
        $this->board = $board;
    
        return $this;
    }

    /**
     * Get board
     *
     * @return \Example\SampleBundle\Entity\Board
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * Add card
     *
     * @param \Example\SampleBundle\Entity\Card $card
     *
     * @return CardList
     */
    public function addCard(\Example\SampleBundle\Entity\Card $card)
    {
        $this->cards[] = $card;
    
        return $this;
    }

    /**
     * Remove card
     *
     * @param \Example\SampleBundle\Entity\Card $card
     */
    public function removeCard(\Example\SampleBundle\Entity\Card $card)
    {
        $this->cards->removeElement($card);
    }

    /**
     * Get cards
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCards()
    {
        return $this->cards;
    }
}
