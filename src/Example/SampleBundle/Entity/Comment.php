<?php
// src\Example\SampleBundle\Entity\Comment.php
namespace Example\SampleBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


 /**
  * @ORM\Entity
  * @ORM\Table(name="comment")
  */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Card", inversedBy="comments")
     * @ORM\JoinColumn(name="card_id", referencedColumnName="id")
     */
    protected $card;

    /**
     * @ORM\Column(type="string", length=150, nullable = true)
     */
    protected $content;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\Column(type="datetime", nullable = true)
     */
    protected $report_date;


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
     * Set content
     *
     * @param string $content
     *
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set reportDate
     *
     * @param \DateTime $reportDate
     *
     * @return Comment
     */
    public function setReportDate($reportDate)
    {
        $this->report_date = $reportDate;
    
        return $this;
    }

    /**
     * Get reportDate
     *
     * @return \DateTime
     */
    public function getReportDate()
    {
        return $this->report_date;
    }

    /**
     * Set card
     *
     * @param \Example\SampleBundle\Entity\Card $card
     *
     * @return Comment
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

    /**
     * Set user
     *
     * @param \Example\SampleBundle\Entity\User $user
     *
     * @return Comment
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
}
