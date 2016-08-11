<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
  * @ORM\Entity(repositoryClass="AppBundle\Entity\ReplyRepository")
  * @ORM\Table(name="reply")
  */
class Reply
{
    /**
      * @ORM\Id
      * @ORM\Column(type="integer")
      *  @ORM\GeneratedValue
      */
    protected $id = null;

    /**
      * @ORM\Column(type="string", name="reply", length=100,  nullable=FALSE)
      */
    protected $reply = null;

    /**
      * @ORM\ManyToOne(targetEntity="Message2", inversedBy="replyMessage")
      * @ORM\JoinColumn(name="message_id", referencedColumnName="id", onDelete="CASCADE")
      */
    protected $message;

    /**
      * @ORM\ManyToOne(targetEntity="Messager", inversedBy="reply")
      * @ORM\JoinColumn(name="messager_id", referencedColumnName="id", onDelete="CASCADE")
      */
    protected $messager;

    public function getId()
    {
        return $this->id;
    }

    public function getReply()
    {
        return$this->reply;
    }

    public function getMessage()
    {
        return$this->message;
    }

    public function getMessager()
    {
        return$this->messager;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setReply($reply)
    {
        $this->reply = $reply;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setMessager($messager)
    {
        $this->messager = $messager;
    }
}
