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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Doctrine\DBAL\LockMode;

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
        $accountNumber = $request->request->get('account');
        $name = $request->request->get('name');
        $phone = $request->request->get('phone');

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
        $em->getConnection()->beginTransaction();
        $amount = $request->request->get('amount');
        $createTime = new \DateTime();

        try {
            $account = $em->find('BankBundle:Account', $accountId, LockMode::PESSIMISTIC_WRITE);
            $balance = $account->getBalance() + $amount;

            $entry = new Entry();
            $entry->setAccount($account);
            $entry->setDatetime($createTime);
            $entry->setBalance($balance);
            $entry->setAmount($amount);
            $account->setBalance($balance);
            $em->persist($entry);
            $em->flush();
            $em->getConnection()->commit();
        } catch (Exception $e) {
            $em->getConnection()->rollBack();

            throw $e;
        }

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
        $em->getConnection()->beginTransaction();
        $amount = $request->request->get('amount') * -1;
        $createTime = new \DateTime();

        try {
            $account = $em->find('BankBundle:Account', $accountId, LockMode::PESSIMISTIC_WRITE);
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
            $em->getConnection()->commit();
        } catch (Exception $e) {
            $em->getConnection()->rollBack();

            throw $e;
        }

        return new JsonResponse(['STATUS' => "Success", 'Account' => $account->getAccount(), 'Amount' => $amount, 'CreateTime' => $createTime, 'Balance' => $balance]);
    }

    /**
     * 列出交易紀錄
     *
     * @Route("/bank/list", name = "list")
     * @Method("GET")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entryId = $request->query->get('entry_id');
        $offset = $request->query->get('offset');
        $limit = $request->query->get('limit');
        $accountId = $request->query->get('account_id');

        $entry = $em->getRepository('BankBundle:Entry')->selectEntry($entryId, $accountId, $offset, $limit);

        if (!$entry) {
            return new JsonResponse(['STATUS' => "Failure"]);
        }

        return new JsonResponse($entry);
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
        $accountId = $request->request->get('account_id');
        $account = $em->find('BankBundle:Account', $accountId);

        if (!$account){
            return new JsonResponse(['STATUS' => "Failure"]);
        }

        $em->remove($account);
        $em->flush();

        return new JsonResponse(['STATUS' => "Success", 'Account' => $account->getAccount()]);
    }
}
