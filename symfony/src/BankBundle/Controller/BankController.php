<?php

namespace BankBundle\Controller;

use BankBundle\Entity\Account;
use BankBundle\Entity\Entry;
use BankBundle\Form;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;

class BankController extends Controller
{
    /**
     * 新增帳戶
     *
     * @Route("/bank/create", name = "create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $accountNumber = $request->query->get('account');
        $name = $request->query->get('name');
        $phone = $request->query->get('phone');

        $checkAccount = $em->getRepository('BankBundle:Account')
            ->findOneBy(['account' => $accountNumber, 'name' => $name, 'phone' => $phone]);

        if (isset($checkAccount)) {
            return new JsonResponse(['STATUS' => "Failure"]);
        }

        $account = new Account();
        $account->setBalance(0);
        $account->setAccount($accountNumber);
        $account->setName($name);
        $account->setPhone($phone);
        $em->persist($account);
        $em->flush();

        return new JsonResponse(['STATUS' => "Success", 'Account' => $accountNumber, 'Name' => $name, 'Phone' => $phone]);
    }

    /**
     * 存錢
     *
     * @Route("/bank/deposit/{accountId}", name = "deposit")
     * @Method("POST")
     */
    public function depositAction(Request $request, $accountId)
    {
        $em = $this->getDoctrine()->getManager();
        $amount = $request->query->get('amount');
        $createTime = new \DateTime();
        $account = $em->find('BankBundle:Account', $accountId);
        $balance = $account->getBalance() + $amount;

        $entry = new Entry();
        $entry->setAccount($account);
        $entry->setDatetime($createTime);
        $entry->setBalance($balance);
        $entry->setAmount($amount);
        $account->setBalance($balance);
        $em->persist($entry);
        $em->flush();

        return new JsonResponse(['STATUS' => "Success", 'Account' => $account->getAccount(), 'Amount' => $amount, 'CreateTime' => $createTime, 'Balance' => $balance]);
    }

    /**
     * 領錢
     *
     * @Route("/bank/withdraw/{accountId}", name = "withdraw")
     * @Method("POST")
     */
    public function withdrawAction(Request $request, $accountId)
    {
        $em = $this->getDoctrine()->getManager();
        $amount = $request->query->get('amount') - $request->query->get('amount') * 2;
        $createTime = new \DateTime();
        $account = $em->find('BankBundle:Account', $accountId);
        $balance = $account->getBalance() + $amount;

        if ($balance < 0) {
            return new JsonResponse(['STATUS' => "Failure"]);
        }

        $entry = new Entry();
        $entry->setAccount($account);
        $entry->setDatetime($createTime);
        $entry->setBalance($balance);
        $entry->setAmount($amount);
        $account->setBalance($balance);
        $em->persist($entry);
        $em->flush();

        return new JsonResponse(['STATUS' => "Success", 'Account' => $account->getAccount(), 'Amount' => $amount, 'CreateTime' => $createTime, 'Balance' => $balance]);
    }

    /**
     * 列出交易紀錄
     *
     * @Route("/bank/list/{accountId}", name = "list")
     * @Method("GET")
     */
    public function showAction(Request $request, $accountId)
    {
        $em = $this->getDoctrine()->getManager();
        $entryId = $request->query->get('entry_id');

        if(!$entryId) {
            $entry = $em->getRepository('BankBundle:Entry')->selectEntry($accountId);

            return new JsonResponse($entry);
        }

        $selectEntry = $em->find('BankBundle:Entry', $entryId);

    return new JsonResponse(['Account' => $selectEntry->getAccount()->getAccount(), 'Amount' => $selectEntry->getAmount(), 'CreateTime' => $selectEntry->getDatetime(), 'Balance' => $selectEntry->getBalance()]);
    }

    /**
     * 刪除帳戶
     *
     * @Route("/bank/delete", name = "delete_account")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $accountId = $request->query->get('account_id');
        $account = $em->find('BankBundle:Account', $accountId);

        if (!$account){
            return new JsonResponse(['STATUS' => "Failure"]);
        }

        $em->remove($account);
        $em->flush();

        return new JsonResponse(['STATUS' => "Success"]);
    }
}
