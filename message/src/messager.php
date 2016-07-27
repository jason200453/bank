<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity()
 * @ORM\Table(name="messager")
 */
class Messager
{
    /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         *  @ORM\GeneratedValue
         */
    protected $id = null;

    /** @ORM\Column(type="string", name="name", length=50, nullable=FALSE) */
    protected $name = null;

    /** @ORM\Column(type="string", name="phone", length=10,  nullable=FALSE) */
    protected $phone = null;

    /** @ORM\Column(type="string", name="email", length=40, nullable=FALSE) */
    protected $email = null;

    /**
         * @ORM\OneToMany(targetEntity="Message2", mappedBy="messager")
         */
    protected $message;

    /**
         * @ORM\OneToMany(targetEntity="Reply", mappedBy="messager")
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
        $this->message = $email;
    }
}
