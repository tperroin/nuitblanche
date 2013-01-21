<?php

namespace IHQS\NuitBlancheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use IHQS\NuitBlancheBundle\Entity\SC2Profile;

class SC2ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('sc2Id')
            ->add('sc2Account', 'text', array('required' => false))
            ->add('sc2Race', 'choice', array('choices' => SC2Profile::$_sc2races))
            ->add('sc2ProfileEsl')
            ->add('sc2ProfilePandaria')
            ->add('sc2ProfileSc2cl')
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class'	=> 'IHQS\NuitBlancheBundle\Entity\SC2Profile',
            'validation_groups'	=> 'Registration'
        );
    }

	public function getName()
	{
		return 'SC2Profile';
	}
}