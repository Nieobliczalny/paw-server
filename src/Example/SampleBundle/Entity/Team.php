<?php
// src\Example\SampleBundle\Entity\Board.php
namespace Example\SampleBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


 /**
  * @ORM\Entity
  * @ORM\Table(name="team")
  */
class Team
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
     * @ORM\ManyToMany(targetEntity="User", inversedBy="team")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $users;

    /**
     * @ORM\OneToMany(targetEntity="Board", mappedBy="team")
     */
    protected $boards;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->boards = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Team
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
     * Add user
     *
     * @param \Example\SampleBundle\Entity\User $user
     *
     * @return Team
     */
    public function addUser(\Example\SampleBundle\Entity\User $user)
    {
        $this->users[] = $user;
    
        return $this;
    }

    /**
     * Remove user
     *
     * @param \Example\SampleBundle\Entity\User $user
     */
    public function removeUser(\Example\SampleBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add board
     *
     * @param \Example\SampleBundle\Entity\Board $board
     *
     * @return Team
     */
    public function addBoard(\Example\SampleBundle\Entity\Board $board)
    {
        $this->boards[] = $board;
    
        return $this;
    }

    /**
     * Remove board
     *
     * @param \Example\SampleBundle\Entity\Board $board
     */
    public function removeBoard(\Example\SampleBundle\Entity\Board $board)
    {
        $this->boards->removeElement($board);
    }

    /**
     * Get boards
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBoards()
    {
        return $this->boards;
    }
}
