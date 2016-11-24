<?php
/**
 * Created by PhpStorm.
 * User: JOBZREFER
 * Date: 11/16/2016
 * Time: 10:42 AM
 */
namespace AppBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->remove('username');  // we use email as the username
        $builder->add('phoneNumber');
        $builder->add('school');
    }

    public function getName()
    {
        return 'jobz_user_registration';
    }
}