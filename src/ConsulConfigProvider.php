<?php


namespace RstGroup\ZfExternalConfigConsulProvider;


use RstGroup\PhpConsulKVArrayGetter\ConsulArrayGetterInterface;
use RstGroup\ZfExternalConfigModule\Config\ConfigProviderInterface;


final class ConsulConfigProvider implements ConfigProviderInterface
{
    /** @var ConsulArrayGetterInterface */
    private $consulConfigProvider;
    /** @var string */
    private $appPrefix;

    /**
     * @param ConsulArrayGetterInterface $consulConfigProvider
     * @param string                     $applicationPrefix
     */
    public function __construct(ConsulArrayGetterInterface $consulConfigProvider, $applicationPrefix = '')
    {
        $this->consulConfigProvider = $consulConfigProvider;
        $this->appPrefix            = (string)$applicationPrefix;
    }

    /**
     * This method returns the config from given provider.
     *
     * Provider itself should be configured while constructing, so no further params are required
     * to fetch configuration data.
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->consulConfigProvider->getByPrefix(
            $this->appPrefix
        );
    }
}
