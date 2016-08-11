<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AlterMessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text')
            ->add('content', 'text')
            ->add('save', 'submit', ['label' => 'Alter Message']);
    }
}
