<?php

namespace IHQS\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use IHQS\NuitBlancheBundle\Form\WysiwygTextareaType;

class PostFormType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('message', new WysiwygTextareaType());
    }

	public function getName()
	{
		return 'Post';
	}
}
