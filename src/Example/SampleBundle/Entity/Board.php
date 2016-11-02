<?php
// src\Example\SampleBundle\Entity\Board.php
namespace Example\SampleBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


 /**
  * @ORM\Entity
  * @ORM\Table(name="board")
  */
class Board
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
     * @ORM\OneToMany(targetEntity="CardList", mappedBy="board")
     */
    protected $cardList;

    /**
     * @ORM\Column(type="string", length=150, nullable = true)
     */
    protected $security;

    /**
     * @ORM\Column(type="boolean", length=150, nullable = true)
     */
    protected $archived;

    /**
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="boards")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    protected $team;

    protected $likeIdList;



    public function __construct()
    {
        $this->cardList = new ArrayCollection();
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set security
     *
     * @param string $security
     *
     * @return Board
     */
    public function setSecurity($security)
    {
        $this->security = $security;
    
        return $this;
    }

    /**
     * Get security
     *
     * @return string
     */
    public function getSecurity()
    {
        return $this->security;
    }

    /**
     * Set archived
     *
     * @param boolean $archived
     *
     * @return Board
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
     * Add cardList
     *
     * @param \Example\SampleBundle\Entity\CardList $cardList
     *
     * @return Board
     */
    public function addCardList(\Example\SampleBundle\Entity\CardList $cardList)
    {
        $this->cardList[] = $cardList;
    
        return $this;
    }

    /**
     * Remove cardList
     *
     * @param \Example\SampleBundle\Entity\CardList $cardList
     */
    public function removeCardList(\Example\SampleBundle\Entity\CardList $cardList)
    {
        $this->cardList->removeElement($cardList);
    }

    /**
     * Get cardList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCardList()
    {
        return $this->cardList;
    }

    /**
     * Set team
     *
     * @param \Example\SampleBundle\Entity\Team $team
     *
     * @return Board
     */
    public function setTeam(\Example\SampleBundle\Entity\Team $team = null)
    {
        $this->team = $team;
    
        return $this;
    }

    /**
     * Get team
     *
     * @return \Example\SampleBundle\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }
}
