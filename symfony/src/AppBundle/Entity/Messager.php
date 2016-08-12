<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass = "AppBundle\Entity\MessagerRepository")
 * @ORM\Table(name = "messager")
 */
class Messager
{
    /**
     * @ORM\Id
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue
     */
    protected $id = null;

    /**
     * @ORM\Column(type = "string", name = "name", length = 50, nullable = false)
     */
    protected $name = null;

    /**
     * @ORM\Column(type = "string", name = "phone", length = 10, nullable = false)
     */
    protected $phone = null;

    /**
     * @ORM\Column(type = "string", name = "email", length = 40, nullable = false)
     */
    protected $email = null;

    /**
     * @ORM\OneToMany(targetEntity = "Message2", mappedBy = "messager")
     */
    protected $message;

    /**
     * @ORM\OneToMany(targetEntity = "Reply", mappedBy = "messager")
     */
    protected $reply;

    public function __construct()
    {
        $this->message = new ArrayCollection();
        $this->reply = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPhone()
    {
        return$this->phone;
    }

     public function getEmail()
    {
        return$this->email;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Add message
     *
     * @param \AppBundle\Entity\Message2 $message
     * @return Messager
     */
    public function addMessage(\AppBundle\Entity\Message2 $message)
    {
        $this->message[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \AppBundle\Entity\Message2 $message
     */
    public function removeMessage(\AppBundle\Entity\Message2 $message)
    {
        $this->message->removeElement($message);
    }

    /**
     * Get message
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Add reply
     *
     * @param \AppBundle\Entity\Reply $reply
     * @return Messager
     */
    public function addReply(\AppBundle\Entity\Reply $reply)
    {
        $this->reply[] = $reply;

        return $this;
    }

    /**
     * Remove reply
     *
     * @param \AppBundle\Entity\Reply $reply
     */
    public function removeReply(\AppBundle\Entity\Reply $reply)
    {
        $this->reply->removeElement($reply);
    }

    /**
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReply()
    {
        return $this->reply;
    }
}
