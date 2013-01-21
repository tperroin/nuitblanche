<?php

namespace IHQS\NuitBlancheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class WarGameGameFormType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder
			->add('date')
			->add('map')
			->add('players', 'collection', array('type' => new WarGameGamePlayerFormType()))
			->add('winner', 'choice', array('choices' => array(0 => '0', 1 => '1', 2 => '2')))
		;
	}

	public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'IHQS\NuitBlancheBundle\Entity\Game',
        );
    }

	public function getName()
	{
		return 'WarGameGame';
	}
}