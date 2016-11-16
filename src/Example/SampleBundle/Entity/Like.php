<?php
// src\Example\SampleBundle\Entity\Like.php
namespace Example\SampleBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


 /**
  * @ORM\Entity
  * @ORM\Table(name="like")
  */
class Like
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Board", inversedBy="likes")
     * @ORM\JoinColumn(name="board_id", referencedColumnName="id")
     */
    protected $board;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="likes")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

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
     * Set table
     *
     * @param string $table
     *
     * @return Like
     */
    public function setTable($table)
    {
        $this->table = $table;
    
        return $this;
    }

    /**
     * Get table
     *
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set user
     *
     * @param \Example\SampleBundle\Entity\User $user
     *
     * @return Like
     */
    public function setUser(\Example\SampleBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Example\SampleBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set board
     *
     * @param \Example\SampleBundle\Entity\Board $board
     *
     * @return Like
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
}
