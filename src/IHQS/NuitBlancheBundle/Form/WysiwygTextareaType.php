<?php

namespace IHQS\NuitBlancheBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class WysiwygTextareaType extends TextareaType
{
    public function buildView(FormView $view, FormInterface $form)
	{
		parent::buildView($view, $form);
		$view->set('attr', array('class' => "wysiwyg_editor"));
	}

	public function getParent(array $options)
	{
		return 'textarea';
	}

	public function getName()
	{
		return 'Wysiwyg';
	}
}