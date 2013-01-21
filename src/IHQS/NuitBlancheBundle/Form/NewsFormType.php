<?php

namespace IHQS\NuitBlancheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use IHQS\NuitBlancheBundle\Entity\News;

class NewsFormType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('team', 'entity', array(
                'required' => false,
                'class'    => 'IHQS\NuitBlancheBundle\Entity\Team',
            ))
            ->add('teamGame', 'entity', array(
                'required' => true,
                'class'    => 'IHQS\NuitBlancheBundle\Entity\TeamGame',
            ))
            ->add('lang', 'choice', array('choices' => News::getLanguages()))
            ->add('body', new WysiwygTextareaType());
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'IHQS\NuitBlancheBundle\Entity\News',
        );
    }

	public function getName()
	{
		return 'News';
	}
}