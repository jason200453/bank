<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity()
 * @ORM\Table(name="message2")
 **/
class Message2
{
    /**
         *  @ORM\Id
         * @ORM\Column(type="integer")
         *  @ORM\GeneratedValue
         */
    protected $id = null;

    /** @ORM\Column(type="string", name="title", length=50, nullable=FALSE) */
    protected $title = null;

    /** @ORM\Column(type="string", name="content", length=100, nullable=FALSE) */
    protected $content = null;

    /** @ORM\OneToMany(targetEntity="Reply", mappedBy="message")*/
    protected $replyMessage = null;

    /** @ORM\ManyToOne(targetEntity="Messager", inversedBy="message")*/
    protected $messager = null;

    public function __construct()
    {
        $this->replyMessage = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getMessager()
    {
        return $this->messager;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }
    
    public function setMessager($messager)
    {
        $this->messager = $messager;
    }
}
