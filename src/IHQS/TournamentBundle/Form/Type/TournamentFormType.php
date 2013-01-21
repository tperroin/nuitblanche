<?php

namespace IHQS\TournamentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TournamentFormType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('name')
            ->add('description', new WysiwygTextareaType())
            ->add('rules', new WysiwygTextareaType())
            ->add('hasSeeds');
        ;
    }

	public function getName()
	{
		return 'Tournament';
	}
}