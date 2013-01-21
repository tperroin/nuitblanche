<?php

namespace IHQS\NuitBlancheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserFormType extends AbstractType
{
    const PASSWORD_NESTED	= "nested";
    const PASSWORD_ALONE	= "alone";
    const PASSWORD_NONE		= "none";

    public static $_passwordModes = array(
        self::PASSWORD_NESTED,
        self::PASSWORD_ALONE,
        self::PASSWORD_NONE
    );

    private $displayPassword;

    public function __construct()
    {
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $this->displayPassword = $options['password'];

        if($this->displayPassword != self::PASSWORD_ALONE)
        {
            $builder->add('username');
        }

        if($this->displayPassword != self::PASSWORD_NONE)
        {
            $builder->add('password', 'repeated', array(
                'type'		=> 'password',
                'first_name'	=> 'Password',
                'second_name'	=> 'Repeat password'))
            ;
        }

        if($this->displayPassword != self::PASSWORD_ALONE)
        {
            $builder
                ->add('email')
                ->add('avatar')
                ->add('firstName')
                ->add('lastName')
                ->add('city')
                ->add('country', 'country', array('preferred_choices' => array('FR', 'SE', 'DE')))
                ->add('facebook')
                ->add('skype')
                ->add('twitter')
                ->add('msn')
                ->add('sc2', new SC2ProfileFormType())
                ->add('wow', new WoWProfileFormType())
            ;
        }
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class'    => 'IHQS\NuitBlancheBundle\Entity\User',
            'password'      => UserFormType::PASSWORD_NESTED,
            'validation_groups'	=> $options['password'] == UserFormType::PASSWORD_ALONE ?
                'Password' :
                'Registration'
        );
    }

    public function getAllowedOptionValues(array $options)
    {
        return array(
            'password'	=> UserFormType::$_passwordModes,
        );
    }

	public function getName()
	{
		return 'User';
	}
}