<?php
// src\Example\SampleBundle\Entity\User.php
namespace Example\SampleBundle\Entity;


use Doctrine\ORM\Mapping as ORM;


 /**
  * @ORM\Entity
  * @ORM\Table(name="user")
  */
class User
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
    protected $username;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $login;

	/**
      * @ORM\Column(type="string", length=100)
      */
    protected $password;

	/**
      * @ORM\Column(type="string", unique=true, length=150)
      */
    protected $email;

    /**
     * @ORM\ManyToMany(targetEntity="Team", mappedBy="users")
     
     */
    protected $team;

    /**
     * @ORM\ManyToMany(targetEntity ="Board", mappedBy="users")
     */
    protected $boards;
    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="user", cascade={"remove"})
     */
    protected $comments;
    /**
     * @ORM\OneToMany(targetEntity="Like", mappedBy="user", cascade={"remove"})
     */
    protected $likes;
	

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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;
    
        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Add comment
     *
     * @param \Example\SampleBundle\Entity\Comment $comment
     *
     * @return User
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
     * Add like
     *
     * @param \Example\SampleBundle\Entity\Like $like
     *
     * @return User
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
     * Add board
     *
     * @param \Example\SampleBundle\Entity\Team $board
     *
     * @return User
     */
    public function addBoard(\Example\SampleBundle\Entity\Team $board)
    {
        $this->boards[] = $board;
    
        return $this;
    }

    /**
     * Remove board
     *
     * @param \Example\SampleBundle\Entity\Team $board
     */
    public function removeBoard(\Example\SampleBundle\Entity\Team $board)
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
    /**
     * Constructor
     */

    

    /**
     * Add team
     *
     * @param \Example\SampleBundle\Entity\Team $team
     *
     * @return User
     */
    public function addTeam(\Example\SampleBundle\Entity\Team $team)
    {
        $this->team[] = $team;
    
        return $this;
    }

    /**
     * Remove team
     *
     * @param \Example\SampleBundle\Entity\Team $team
     */
    public function removeTeam(\Example\SampleBundle\Entity\Team $team)
    {
        $this->team->removeElement($team);
    }

    /**
     * Get team
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeam()
    {
        return $this->team;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->team = new \Doctrine\Common\Collections\ArrayCollection();
        $this->boards = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->likes = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
