<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CheckType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add('name', 'text')
            ->add('email', 'text')
            ->add('phone', 'text')
            ->add('leave', 'submit', ['label' => 'I want leave message'])
            ->add('reply', 'submit', ['label' => 'I want reply message']);   
    }
}
