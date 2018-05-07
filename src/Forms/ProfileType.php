<?php
/**
 * Created by PhpStorm.
 * User: nicol
 * Date: 07/05/2018
 * Time: 20:35
 */

namespace App\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->remove('email')
            ->remove('plainPassword')
            ->remove('username');
        $builder
            ->add('name')
            ->add('age')
            ->add('family')
            ->add('race')
            ->add('food');
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

}