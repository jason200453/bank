<?php

namespace BankBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('amount', 'integer')
            ->add('add', 'submit', ['label' => '存款'])
            ->add('minus', 'submit', ['label' => '提款']);
    }
}

