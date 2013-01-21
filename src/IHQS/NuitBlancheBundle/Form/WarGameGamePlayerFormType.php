<?php

namespace IHQS\NuitBlancheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use IHQS\NuitBlancheBundle\Entity\SC2Profile;

class WarGameGamePlayerFormType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('team', 'hidden')
            ->add('race', 'choice', array('choices' => SC2Profile::$_sc2races))
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'IHQS\NuitBlancheBundle\Entity\GamePlayer',
        );
    }

	public function getName()
	{
		return 'WarGameGamePlayer';
	}
}