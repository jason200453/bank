<?php

namespace BankBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 明細
 *
 * @ORM\Entity()
 * @ORM\Table(name = "entry")
 */
class Entry
{
    /**
     * @ORM\Id
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue
     */
    private $id = null;

    /**
     * 交易金額
     *
     * @ORM\Column(type = "integer", name = "amount", length = 20, nullable = false)
     */
    private $amount = null;

    /**
     * 交易日期時間
     *
     * @ORM\Column(type = "datetimetz", name = "datetime", nullable = false)
     */
    private $datetime = null;

    /**
     * 此筆交易後之餘額
     *
     * @ORM\Column(type = "integer", name = "balance", length = 100, nullable = false)
     */
    private $balance = null;

    /**
     * @ORM\ManyToOne(targetEntity = "Account", inversedBy = "entry")
     * @ORM\JoinColumn(name = "account_id", referencedColumnName = "id", onDelete = "CASCADE")
     */
    private $account = null;

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
     * 創建交易金額
     *
     * @param integer $amount
     * @return Entry
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * 取得交易金額
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * 創建交易時間
     *
     * @param \DateTime $datetime
     * @return Entry
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * 取得交易時間
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * 創建此筆交易之後之餘額
     *
     * @param integer $balance
     * @return Entry
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * 取得此筆交易之後之餘額
     *
     * @return integer
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * 創建帳戶
     *
     * @param \BankBundle\Entity\Account $account
     * @return Entry
     */
    public function setAccount(\BankBundle\Entity\Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * 取得帳戶
     *
     * @return \BankBundle\Entity\Account
     */
    public function getAccount()
    {
        return $this->account;
    }
}
