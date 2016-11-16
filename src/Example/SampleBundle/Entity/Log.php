<?php
// src\Example\SampleBundle\Entity\Log.php
namespace Example\SampleBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


 /**
  * @ORM\Entity
  * @ORM\Table(name="log")
  */
class Log
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\OneToMany(targetEntity="Entry", mappedBy="log")
     */
    protected $entries;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->entries = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add entry
     *
     * @param \Example\SampleBundle\Entity\Entry $entry
     *
     * @return Log
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
