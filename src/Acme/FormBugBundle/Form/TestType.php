<?php

namespace Acme\FormBugBundle\Form;

use \Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password', 'text', [
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])
            ->add('submit', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'attr' => [
                'novalidate' => 'novalidate',
            ],
            'data_class' => 'Acme\FormBugBundle\Entity\User',
            'constraints' => [
                new UniqueEntity([
                    'fields' => ['username'],
                    'errorPath' => 'password',
                    'message' => 'username_exists',
                ])
            ]
        ]);
    }


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'form_test';
    }
}