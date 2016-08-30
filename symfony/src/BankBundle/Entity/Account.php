<?php

namespace BankBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * 帳戶
 *
 * @ORM\Entity()
 * @ORM\Table(name = "account")
 */
class Account
{
    /**
     * @ORM\Id
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue
     */
    private $id = null;

    /**
     * 帳號
     *
     * @ORM\Column(type = "string", name = "account", length = 20, nullable = false)
     */
    private $account = null;

    /**
     * 姓名
     *
     * @ORM\Column(type = "string", name = "name", length = 10, nullable = false)
     */
    private $name = null;

    /**
     * 電話
     *
     * @ORM\Column(type = "string", name = "phone", length = 10, nullable = false)
     */
    private $phone = null;

    /**
     * 帳戶餘額
     *
     * @ORM\Column(type = "integer", name = "balance", length = 100, nullable = false)
     */
    private $balance = null;

    /**
     * @ORM\Version
     * @ORM\Column(type="integer")
     */
    private $version;

    /**
     * @ORM\OneToMany(targetEntity = "Entry", mappedBy = "account")
     */
    private $entry;

    public function __construct()
    {
        $this->entry = new ArrayCollection();
    }

    /**
     * 取得id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 取得version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * 創建帳號
     *
     * @param string $account
     * @return Account
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * 取得帳號
     *
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * 創建姓名
     *
     * @param string $name
     * @return Account
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * 取得姓名
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * 創建電話
     *
     * @param string $phone
     * @return Account
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * 取得電話
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * 創建帳戶餘額
     *
     * @param integer $balance
     * @return Account
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * 取得帳戶餘額
     *
     * @return integer
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * 新增明細
     *
     * @param \BankBundle\Entity\Entry $entry
     * @return Account
     */
    public function addEntry(\BankBundle\Entity\Entry $entry)
    {
        $this->entry[] = $entry;

        return $this;
    }

    /**
     * 移除明細
     *
     * @param \BankBundle\Entity\Entry $entry
     */
    public function removeEntry(\BankBundle\Entity\Entry $entry)
    {
        $this->entry->removeElement($entry);
    }

    /**
     * 取得明細
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntry()
    {
        return $this->entry;
    }
}
