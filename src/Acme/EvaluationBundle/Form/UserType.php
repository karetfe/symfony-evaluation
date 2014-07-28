<?php
namespace Acme\EvaluationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username')
            ->add('password', 'password')
            ->add('email')
            ->add('name')
            ->add('save', 'submit')
            ->add('reset', 'reset');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Acme\EvaluationBundle\Entity\User',
            ));
    }

    public function getName()
    {
        return 'name';
    }
}