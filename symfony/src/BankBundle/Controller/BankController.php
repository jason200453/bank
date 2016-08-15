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
     * @Route("/bank/service", name = "service")
     */
    public function serviceAction(Request $request)
    {
        return $this->render('BankBundle:Default:index.html.twig');
    }

}