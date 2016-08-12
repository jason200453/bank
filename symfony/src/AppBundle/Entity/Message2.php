<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass = "AppBundle\Entity\MessageRepository")
 * @ORM\Table(name = "message2")
 */
class Message2
{
    /**
     * @ORM\Id
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue
     */
    protected $id = null;

    /**
     * @ORM\Column(type = "string", name = "title", length = 50, nullable = false)
     */
    protected $title = null;

    /**
     * @ORM\Column(type = "string", name = "content", length = 100, nullable = false)
     */
    protected $content = null;

    /**
     * @ORM\OneToMany(targetEntity = "Reply", mappedBy = "message")
     */
    protected $replyMessage = null;

    /**
     * @ORM\ManyToOne(targetEntity = "Messager", inversedBy = "message")
     */
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

    /**
     * Add replyMessage
     *
     * @param \AppBundle\Entity\Reply $replyMessage
     * @return Message2
     */
    public function addReplyMessage(\AppBundle\Entity\Reply $replyMessage)
    {
        $this->replyMessage[] = $replyMessage;

        return $this;
    }

    /**
     * Remove replyMessage
     *
     * @param \AppBundle\Entity\Reply $replyMessage
     */
    public function removeReplyMessage(\AppBundle\Entity\Reply $replyMessage)
    {
        $this->replyMessage->removeElement($replyMessage);
    }

    /**
     * Get replyMessage
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReplyMessage()
    {
        return $this->replyMessage;
    }
}
