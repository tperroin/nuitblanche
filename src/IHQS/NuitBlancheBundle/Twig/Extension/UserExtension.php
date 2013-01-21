<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IHQS\NuitBlancheBundle\Twig\Extension;

use Symfony\Component\Security\Acl\Voter\FieldVote;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * SecurityExtension exposes security context features.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class UserExtension extends \Twig_Extension
{
    private $context;

    public function __construct(SecurityContextInterface $context = null)
    {
        $this->context = $context;
    }

    public function getConnectedUser()
    {
		if(!$this->context->getToken())
		{
			return null;
		}
        return $this->context->getToken()->getUser();
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'connected_user' => new \Twig_Function_Method($this, 'getConnectedUser'),
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'User';
    }
}
