<?php
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="reply")
 **/
class Reply
{
    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue **/
    protected $id = null;
    /** @ORM\Column(type="string", name="name", length=20, nullable=FALSE) **/
    protected $name = null;
    /** @ORM\Column(type="string", name="reply", length=100,  nullable=FALSE) **/
    protected $reply = null;
    /**
         * @ORM\ManyToOne(targetEntity="Message2", inversedBy="replyMessage")
         * @ORM\JoinColumn(name="message_id", referencedColumnName="id", onDelete="CASCADE")
         */
    protected $message;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getReply()
    {
        return$this->reply;
    }

    public function getMessage()
    {
        return$this->message;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setReply($reply)
    {
        $this->reply = $reply;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }
}