<?php

namespace IHQS\TournamentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use IHQS\TournamentBundle\Entity\Round;

class MatchReportFormType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('player1Score')
            ->add('player2Score')
        ;
    }

	public function getName()
	{
		return 'MatchReport';
	}
}