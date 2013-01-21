<?php

namespace IHQS\TournamentBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

class IHQSTournamentExtension extends Extension
{
    /**
     * Gets the entity repository for the given entity manager and class
     *
     * @version		1.0
     * @author		Antoine Berranger <antoine@ihqs.net>
     *
     * @param EntityManager     $entityManager
     * @param string            $class
     *
     * @return EntityRepository
     */
    public static function getRepository($em, $class)
    {
        return $em->getRepository($class);
    }
    
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = array();
        foreach ($configs as $c) {
            $config = array_merge($config, $c);
        }
		
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('orm.xml');

		if(!isset($config['model']))
		{
			throw new \InvalidArgumentException('You must define a model configuration');
		}

		if(!isset($config['model']['user_class']))
		{
			throw new \InvalidArgumentException('You must define a model user class');
		}

		$container->setParameter('ihqs_tournament.model.user.class', $config['model']['user_class']);
    }

    public function getAlias()
    {
        return 'ihqs_tournament';
    }
}
