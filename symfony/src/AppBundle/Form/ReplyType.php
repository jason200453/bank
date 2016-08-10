<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ReplyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder->add('reply', 'text')
            ->add('save', 'submit', ['label' => 'Reply']);
    }
}
