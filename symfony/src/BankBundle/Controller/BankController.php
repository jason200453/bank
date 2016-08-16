<?php

namespace BankBundle\Controller;

use BankBundle\Entity\Account;
use BankBundle\Entity\Entry;
use BankBundle\Form;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BankController extends Controller
{
    /**
     * 檢查是否曾經使用過銀行存提系統，如果沒有使用過先存入使用者資料
     *
     * @Route("/bank", name = "bank")
     */
    public function checkAction(Request $request)
    {
        $account = new Account();
        $form = $this->createForm(Form\CheckType::class, $account);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $account = $form->getData();
            $em = $this->getDoctrine()->getManager();

            $checkAccount = $em->getRepository('BankBundle:Account')
                ->checkAccount($account->getAccount(), $account->getName(), $account->getPhone());

            if (!$checkAccount) {
                $account->setBalance(0);
                $em->persist($account);
                $em->flush();

                return $this->redirectToRoute('service', ['accountId' => $account->getId()]);
            }

            return $this->redirectToRoute('service', ['accountId' => $checkAccount->getId()]);
        }

        return $this->render('bank/check.html.twig', ['form' => $form->createView()]);
    }

    /**
     * 銀行存提系統，按鈕分為存款與提款
     *
     * @Route("/bank/service", name = "service")
     */
    public function serviceAction(Request $request)
    {
        $accountId = $request->query->get('accountId');
        $entry = new Entry();
        $form = $this->createForm(Form\ServiceType::class, $entry);

        $form->handleRequest($request);

        if ($form->get('add')->isClicked() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $amountForm = $form->getData();
            $createTime = new \DateTime();
            $user = $em->find("BankBundle:Account", $accountId);
            $selectBalance = $em->getRepository('BankBundle:Account')
                ->selectAccount($accountId);
            $balance = $selectBalance->getBalance()+$amountForm->getAmount();

            $entry->setAccount($user);
            $entry->setDatetime($createTime);
            $entry->setBalance($balance);
            $entry->setAmount($amountForm->getAmount());
            $em->persist($entry);
            $em->flush();

            $em->getRepository('BankBundle:Account')
                ->alterBalance($balance, $accountId);

            return $this->redirectToRoute('bank');
        }

        if ($form->get('minus')->isClicked() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $amountForm = $form->getData();
            $createTime = new \DateTime();
            $user = $em->find("BankBundle:Account", $accountId);
            $selectBalance = $em->getRepository('BankBundle:Account')
                ->selectAccount($accountId);
            $balance = $selectBalance->getBalance()-$amountForm->getAmount();
            $amount = $amountForm->getAmount()-$amountForm->getAmount()*2;

            $entry->setAccount($user);
            $entry->setDatetime($createTime);
            $entry->setBalance($balance);
            $entry->setAmount($amount);
            $em->persist($entry);
            $em->flush();

            $em->getRepository('BankBundle:Account')
                ->alterBalance($balance, $accountId);

            return $this->redirectToRoute('bank');
        }

        return $this->render('bank/service.html.twig', ['form' => $form->createView()]);
    }

}