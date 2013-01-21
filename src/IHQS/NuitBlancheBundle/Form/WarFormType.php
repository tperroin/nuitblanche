<?php

namespace IHQS\NuitBlancheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class WarFormType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('maps')
            ->add('season')
            ->add('team')
            ->add('teamScore', 'integer')
            ->add('opponentScore', 'integer')
            ->add('opponentName')
            ->add('opponentCountry', 'country', array('preferred_choices' => array('FR', 'SE', 'DE')))
            ->add('numberOf1on1Games', 'integer')
            ->add('numberOf2on2Games', 'integer')
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'IHQS\NuitBlancheBundle\Entity\War',
        );
    }

	public function getName()
	{
		return 'War';
	}
}