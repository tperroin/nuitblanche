<?php



namespace IHQS\NuitBlancheBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */

class Unique extends Constraint
{
    public $message = 'The value for "%property%" already exists.';

    public function validatedBy()
    {
        return 'Unique';
    }

	public function getTargets()
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
