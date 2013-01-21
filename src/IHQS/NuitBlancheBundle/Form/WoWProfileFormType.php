<?php

namespace IHQS\NuitBlancheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use IHQS\NuitBlancheBundle\Entity\User;
use IHQS\NuitBlancheBundle\Entity\WoWProfile;

class WoWProfileFormType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('race', 'choice',     array('choices' => WoWProfile::$_races))
            ->add('class', 'choice',    array('choices' => WoWProfile::$_classes))
            ->add('sex', 'choice',      array('choices' => User::$_sexes))
            ->add('name', 'text')
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class'	=> 'IHQS\NuitBlancheBundle\Entity\WoWProfile',
            'validation_groups'	=> 'Registration'
        );
    }

	public function getName()
	{
		return 'WoWProfile';
	}
}