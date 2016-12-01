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
    protected $path;

    /**
     * @ORM\ManyToOne(targetEntity="Card", inversedBy="attachments")
     * @ORM\JoinColumn(name="cardList_id", referencedColumnName="id")
     */
    protected $card;

}