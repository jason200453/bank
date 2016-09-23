<?php

namespace BankBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use BankBundle\Entity\Account;

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
            return new JsonResponse(['result' => 'failure']);
        }

        $account = new Account();
        $account->setBalance(0);
        $account->setAccount($accountNumber);
        $account->setName($name);
        $account->setPhone($phone);
        $account->setVersion(0);
        $em->persist($account);
        $em->flush();

        $output = [
            'result'=> 'ok',
            'account' => $account->getAccount(),
            'amount' => $accountNumber,
            'name' => $name,
            'phone' => $phone
        ];

        return new JsonResponse($output);
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
        $amount = $request->request->get('amount');
        $createTime = date('Y-m-d H:i:s');
        $redis = $this->container->get('snc_redis.default');

        try {
            $account = $em->find('BankBundle:Account', $accountId);

            if (!$account) {
                throw new \Exception('Something went wrong!');
            }

            $redis->multi();
            $redis->incr('entryId');
            $redis->hincrby($accountId, 'balance', $amount);
            $redis->hincrby($accountId, 'version', 1);
            $redis->sadd('account', $accountId);
            $result = $redis->exec();
            $entryId = $result[0];
            $balance = $result[1];

            $entry = [
                'entry_id' => $entryId,
                'account_id' => $accountId,
                'amount' => $amount,
                'balance' => $balance,
                'datetime' => $createTime,
            ];

            $redis->rpush('entry',  json_encode($entry));
        } catch (\Exception  $e) {

            throw $e;
        }

        $output = [
            'result'=> 'ok',
            'account' => $account->getAccount(),
            'amount' => $amount,
            'create_time' => $createTime,
            'balance' => $balance
        ];

        return new JsonResponse($output);
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
        $amount = $request->request->get('amount') * -1;
        $createTime = date('Y-m-d H:i:s');
        $redis = $this->container->get('snc_redis.default');

        try {
            $account = $em->find('BankBundle:Account', $accountId);

            if (!$account) {
                throw new \Exception('Something went wrong!');
            }

            $redis->multi();
            $redis->incr('entryId');
            $redis->hincrby($accountId, 'balance', $amount);
            $redis->hincrby($accountId, 'version', 1);
            $redis->sadd('account', $accountId);
            $result = $redis->exec();

            if ($result[1] < 0) {
                $redis->multi();
                $redis->decr('entryId');
                $redis->hincrby($accountId, 'balance', $amount * -1);
                $redis->hincrby($accountId, 'version', 1);
                $redis->exec();

                return new JsonResponse(['result' => 'failure']);
            }

            $entryId = $result[0];
            $balance = $result[1];

            $entry = [
                'entry_id' => $entryId,
                'account_id' => $accountId,
                'amount' => $amount,
                'balance' => $balance,
                'datetime' => $createTime,
            ];

            $redis->rpush('entry',  json_encode($entry));
        } catch (\Exception $e) {

            throw $e;
        }

        $output = [
            'result'=> 'ok',
            'account' => $account->getAccount(),
            'amount' => $amount,
            'create_time' => $createTime,
            'balance' => $balance
        ];

        return new JsonResponse($output);
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
            return new JsonResponse(['result' => 'failure']);
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
            return new JsonResponse(['result' => 'failure']);
        }

        $em->remove($account);
        $em->flush();

        $output = [
            'result'=> 'ok',
            'account' => $account->getAccount()
        ];

        return new JsonResponse($output);
    }
}
