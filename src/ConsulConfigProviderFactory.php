<?php


namespace RstGroup\ZfExternalConfigConsulProvider;

use Interop\Container\ContainerInterface;
use RstGroup\PhpConsulConfigProvider\Consul\ConfigProvider;
use SensioLabs\Consul\ServiceFactory;
use SensioLabs\Consul\Services\KVInterface;

/** @codeCoverageIgnore */
final class ConsulConfigProviderFactory
{
    /**
     * @param ContainerInterface $container
     * @return ConsulConfigProvider
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');

        $serviceFactory = new ServiceFactory([
            'base_url' => $config['rst_group']['external_config']['consul']['base_uri']
        ]);

        $provider = new ConfigProvider(
            $serviceFactory->get(KVInterface::class)
        );

        return new ConsulConfigProvider(
            $provider,
            $config['rst_group']['external_config']['consul']['prefix']
        );
    }
}
