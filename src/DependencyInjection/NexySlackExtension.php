<?php

namespace Nexy\SlackBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class NexySlackExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('nexy_slack.endpoint', $config['endpoint']);
        unset($config['endpoint']);
        $container->setParameter('nexy_slack.config', $config);
    }
}
