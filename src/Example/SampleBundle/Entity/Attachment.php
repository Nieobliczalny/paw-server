<?php
// src\Example\SampleBundle\Entity\Board.php
namespace Example\SampleBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


 /**
  * @ORM\Entity
  * @ORM\Table(name="attachment")
  */
class Attachment
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
     * @ORM\ManyToOne(targetEntity="Card", inversedBy="attachments")
     * @ORM\JoinColumn(name="cardList_id", referencedColumnName="id")
     */
    protected $card;

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
     * @return Attachment
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
     * Set card
     *
     * @param \Example\SampleBundle\Entity\Card $card
     *
     * @return Attachment
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
}
