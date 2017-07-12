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

        $httpClientConfig = isset($config['consul']['http_client']) ? $config['consul']['http_client'] : [];
        $consulKeyPrefix = isset($config['consul']['prefix']) ? $config['consul']['prefix'] : '';

        $serviceFactory = new ServiceFactory($httpClientConfig);

        $provider = new ConsulArrayGetter(
            $serviceFactory->get(KVInterface::class)
        );

        return new ConsulConfigProvider(
            $provider,
            $consulKeyPrefix
        );
    }
}
