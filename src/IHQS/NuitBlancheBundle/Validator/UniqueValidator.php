<?php

namespace IHQS\NuitBlancheBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * UniqueValidator
 */
class UniqueValidator extends ConstraintValidator
{
    protected $manager;

    /**
     * Constructor
     *
     * @param $manager
     */
    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    /**
     * Indicates whether the constraint is valid
     *
     * @param mixed	     $value
     * @param Constraint $constraint
     */
    public function isValid($value, Constraint $constraint)
    {
		$class	= $this->context->getCurrentClass();
		$field	= $this->context->getCurrentProperty();

		$repo	= $this->manager->getRepository($class);
		$match	= $repo->findBy(array($field => $value));

        if(count($match) > 0)
		{
            $this->setMessage($constraint->message, array(
                '%property%' => $field
            ));
            return false;
        }

        return true;
    }
}
