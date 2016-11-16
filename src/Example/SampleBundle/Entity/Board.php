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
     * @ORM\OneToMany(targetEntity="CardList", mappedBy="board", cascade={"remove"})
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

    /**
     * @ORM\OneToOne(targetEntity="Log")
     * @ORM\JoinColumn(name="log_id", referencedColumnName="id")
     */
    protected $log;

    /**
     * @ORM\OneToMany(targetEntity="Like", mappedBy="board", cascade={"remove"})
     */
    protected $likes;
    

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

    /**
     * Set log
     *
     * @param \Example\SampleBundle\Entity\Log $log
     *
     * @return Board
     */
    public function setLog(\Example\SampleBundle\Entity\Log $log = null)
    {
        $this->log = $log;
    
        return $this;
    }

    /**
     * Get log
     *
     * @return \Example\SampleBundle\Entity\Log
     */
    public function getLog()
    {
        return $this->log;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cardList = new \Doctrine\Common\Collections\ArrayCollection();
        $this->likes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add like
     *
     * @param \Example\SampleBundle\Entity\Like $like
     *
     * @return Board
     */
    public function addLike(\Example\SampleBundle\Entity\Like $like)
    {
        $this->likes[] = $like;
    
        return $this;
    }

    /**
     * Remove like
     *
     * @param \Example\SampleBundle\Entity\Like $like
     */
    public function removeLike(\Example\SampleBundle\Entity\Like $like)
    {
        $this->likes->removeElement($like);
    }

    /**
     * Get likes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLikes()
    {
        return $this->likes;
    }
}
