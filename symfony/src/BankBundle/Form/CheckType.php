<?php

namespace BankBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CheckType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('account', 'text')
            ->add('name', 'text')
            ->add('phone', 'text')
            ->add('save', 'submit', ['label' => 'I want use service'])
            ->add('list', 'submit', ['label' => '查看歷史交易紀錄']);
    }
}
