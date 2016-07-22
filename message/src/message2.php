<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity()
 * @ORM\Table(name="message2")
 **/
class Message2
{
    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue **/
    protected $id = null;
    /** @ORM\Column(type="string", name="name", length=20, nullable=FALSE) **/
    protected $name = null;
    /** @ORM\Column(type="string", name="title", length=50, nullable=FALSE) **/
    protected $title = null;
    /** @ORM\Column(type="string", name="email", length=40, nullable=FALSE) **/
    protected $email = null;
    /** @ORM\Column(type="string", name="content", length=100, nullable=FALSE) **/
    protected $content = null;
    /**
         * @ORM\OneToMany(targetEntity="Reply", mappedBy="message")
         **/        
    protected $replyMessage = null;

    public function __construct()
    {
        $this->replyMessage = new ArrayCollection();
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }
}
