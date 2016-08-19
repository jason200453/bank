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

        if ($form->get('save')->isClicked() && $form->isValid()) {
            $accountForm = $form->getData();
            $em = $this->getDoctrine()->getManager();

            $checkAccount = $em->getRepository('BankBundle:Account')
                ->findOneBy(['account' => $accountForm->getAccount(), 'name' => $accountForm->getName(), 'phone' => $accountForm->getPhone()]);

            if (!$checkAccount) {
                $account->setBalance(0);
                $em->persist($account);
                $em->flush();

                return $this->redirectToRoute('service', ['account_id' => $account->getId()]);
            }

            return $this->redirectToRoute('service', ['account_id' => $checkAccount->getId()]);
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
        $accountId = $request->query->get('account_id');
        $entry = new Entry();
        $form = $this->createForm(Form\ServiceType::class, $entry);

        $form->handleRequest($request);

        if ($form->get('add')->isClicked() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $amountForm = $form->getData();
            $createTime = new \DateTime();
            $user = $em->find("BankBundle:Account", $accountId);
            $balance = $user->getBalance() + $amountForm->getAmount();

            $entry->setAccount($user);
            $entry->setDatetime($createTime);
            $entry->setBalance($balance);
            $entry->setAmount($amountForm->getAmount());
            $user->setBalance($balance);
            $em->persist($entry);
            $em->flush();

            return $this->redirectToRoute('show', ['entry_id' => $entry->getId()]);
        }

        if ($form->get('minus')->isClicked() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $amountForm = $form->getData();
            $createTime = new \DateTime();
            $user = $em->find("BankBundle:Account", $accountId);
            $balance = $user->getBalance() - $amountForm->getAmount();
            $amount = $amountForm->getAmount() - $amountForm->getAmount() * 2;

            if ($balance < 0) {
                return $this->redirectToRoute('show');
            }

            $entry->setAccount($user);
            $entry->setDatetime($createTime);
            $entry->setBalance($balance);
            $entry->setAmount($amount);
            $user->setBalance($balance);
            $em->persist($entry);
            $em->flush();

            return $this->redirectToRoute('show', ['entry_id' => $entry->getId()]);
        }

        return $this->render('bank/service.html.twig', ['form' => $form->createView(), 'account_id' => $accountId]);
    }

    /**
     * 交易明細
     *
     * @Route("/bank/show", name = "show")
     */
    public function showAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entryId = $request->query->get('entry_id');

        if (!$entryId) {
            return $this->render('bank/showerror.html.twig');
        }

        $selectEntry = $em->getRepository('BankBundle:Entry')->find($entryId);

        return $this->render('bank/show.html.twig', ['entry' => $selectEntry]);
    }

    /**
     * 列出歷史交易紀錄
     *
     * @Route("/bank/list", name = "list")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $accountId = $request->query->get('account_id');

        $allEntry = $em->getRepository('BankBundle:Entry')->findByAccount($accountId);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate($allEntry, $request->query->getInt('page', 1), 10);

        return $this->render('bank/list.html.twig', ['pagination' => $pagination]);
    }
}