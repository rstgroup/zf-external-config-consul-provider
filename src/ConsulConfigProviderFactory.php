<?php


namespace RstGroup\ZfExternalConfigConsulProvider;


use Psr\Container\ContainerInterface;
use RstGroup\PhpConsulKVArrayGetter\Consul\ConsulArrayGetter;
use RstGroup\ZfExternalConfigModule\Config\ExternalConfigListener;
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
        $config = $container->get(ExternalConfigListener::SERVICE_EXTERNALS_CONFIG);

        $serviceFactory = new ServiceFactory([
            'base_uri' => $config['consul']['base_uri'],
        ]);

        $provider = new ConsulArrayGetter(
            $serviceFactory->get(KVInterface::class)
        );

        return new ConsulConfigProvider(
            $provider,
            $config['consul']['prefix']
        );
    }
}
