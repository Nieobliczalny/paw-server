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
     * @ORM\OneToMany(targetEntity="Entry", mappedBy="boardId")
     */
    protected $entries;

    /**
     * @ORM\OneToMany(targetEntity="Like", mappedBy="board", cascade={"remove"})
     */
    protected $likes;

    /**
     * @ORM\OneToMany(targetEntity="Tag",mappedBy="board", cascade={"remove"})
     */
    protected $tags;
    

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cardList = new \Doctrine\Common\Collections\ArrayCollection();
        $this->likes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Board
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

    /**
     * Add tag
     *
     * @param \Example\SampleBundle\Entity\Tag $tag
     *
     * @return Board
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
     * Add entry
     *
     * @param \Example\SampleBundle\Entity\Entry $entry
     *
     * @return Board
     */
    public function addEntry(\Example\SampleBundle\Entity\Entry $entry)
    {
        $this->entries[] = $entry;
    
        return $this;
    }

    /**
     * Remove entry
     *
     * @param \Example\SampleBundle\Entity\Entry $entry
     */
    public function removeEntry(\Example\SampleBundle\Entity\Entry $entry)
    {
        $this->entries->removeElement($entry);
    }

    /**
     * Get entries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntries()
    {
        return $this->entries;
    }
}
