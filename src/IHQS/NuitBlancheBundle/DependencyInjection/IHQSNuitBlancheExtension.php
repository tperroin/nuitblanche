<?php

namespace IHQS\NuitBlancheBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

class IHQSNuitBlancheExtension extends Extension
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
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('form.xml');
        $loader->load('model.xml');
        $loader->load('services.xml');
    }

    public function getAlias()
    {
        return 'ihqs_nuit_blanche';
    }
}
