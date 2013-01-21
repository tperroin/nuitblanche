<?php

namespace IHQS\NuitBlancheBundle\Twig\Extension;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;

class InnerBlocksExtension extends \Twig_Extension
{
    protected $loader;
    protected $container;

    public function __construct(FilesystemLoader $loader, ContainerInterface $container)
    {
        $this->loader = $loader;
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            'innerBlocks' => new \Twig_Filter_Method($this, 'processInnerBlocks', array('is_safe' => array('html'))),
        );
    }

    public function processInnerBlocks($template)
    {
		preg_match_all('/\{war:([0-9]+)\}/', $template, $matches, PREG_SET_ORDER);

		foreach($matches as $match)
		{
			$replace  = $this->container->get('http_kernel')->render('IHQSNuitBlancheBundle:War:_games', array('attributes' => array('war_id' => $match[1])));
			$template = str_replace($match[0], $replace, $template);
		}

		preg_match_all('/\{player:([\w]+)\}/', $template, $matches, PREG_SET_ORDER);

		foreach($matches as $match)
		{
			$replace  = $this->container->get('http_kernel')->render('IHQSNuitBlancheBundle:Player:_widget', array('attributes' => array('player_name' => $match[1])));
			$template = str_replace($match[0], $replace, $template);
		}

		return $template;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'inner_blocks';
    }
}
