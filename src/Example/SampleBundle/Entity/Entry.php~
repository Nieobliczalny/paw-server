<?php
// src\Example\SampleBundle\Entity\Entry.php
namespace Example\SampleBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


 /**
  * @ORM\Entity
  * @ORM\Table(name="entry")
  */
class Entry
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
    protected $content;

    /**
     * @ORM\Column(type="datetime", nullable = true)
     */
    protected $report_date;

    /**
     * @ORM\ManyToOne(targetEntity="Board", inversedBy="entries")
     * @ORM\JoinColumn(name="boardId", referencedColumnName="id")
     */
    protected $boardId;


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
     * @return Entry
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
     * @return Entry
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
     * Set board
     *
     * @param \Example\SampleBundle\Entity\Board $board
     *
     * @return Entry
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
