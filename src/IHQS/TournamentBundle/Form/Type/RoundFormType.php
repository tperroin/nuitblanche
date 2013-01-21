<?php

namespace IHQS\TournamentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use IHQS\TournamentBundle\Entity\Round;

class RoundFormType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('type', 'choice', array('choices' => Round::getAllowedTypes()))
            ->add('playerLimit')
            ->add('order')
            ->add('infos', new WysiwygTextareaType())
        ;
    }

	public function getName()
	{
		return 'Round';
	}
}