<?php

namespace IHQS\NuitBlancheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class WarGameFormType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder->add('games', 'collection', array(
			'type' => new WarGameGameFormType(),
		));

		$builder->add('team1score', 'hidden');
		$builder->add('team2score', 'hidden');
	}

	public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'IHQS\NuitBlancheBundle\Entity\WarGame',
        );
    }

	public function getName()
	{
		return 'WarGame';
	}
}