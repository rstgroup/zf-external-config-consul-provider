<?php


namespace RstGroup\ZfExternalConfigConsulProvider;

use RstGroup\PhpConsulKVArrayGetter\ConsulArrayGetterInterface;
use RstGroup\ZfExternalConfigModule\Config\ConfigProviderInterface;

final class ConsulConfigProvider implements ConfigProviderInterface
{
    /** @var ConsulArrayGetterInterface */
    private $consulConfigProvider;
    /** @var string|null */
    private $appPrefix;

    public function __construct(ConsulArrayGetterInterface $consulConfigProvider, $applicationPrefix = null)
    {
        $this->consulConfigProvider = $consulConfigProvider;
        $this->appPrefix            = $applicationPrefix;
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
            $this->appPrefix ?: ''
        );
    }
}
