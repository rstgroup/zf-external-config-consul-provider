<?php


namespace RstGroup\ZfExternalConfigConsulProvider\Tests;


use PHPUnit\Framework\TestCase;
use RstGroup\PhpConsulKVArrayGetter\ConsulArrayGetterInterface;
use RstGroup\ZfExternalConfigConsulProvider\ConsulConfigProvider;


class ConsulConfigProviderTest extends TestCase
{
    public function testItReturnsConfigFetchedFromConsul()
    {
        // given: mocked consul config provider
        $configProvider = $this->getMockBuilder(ConsulArrayGetterInterface::class)->getMock();
        $configProvider->method('getByPrefix')->willReturnMap([
            ['application', ['application' => ['x' => 'y']]]
        ]);

        $provider = new ConsulConfigProvider(
            $configProvider,
            'application'
        );

        // when
        $this->assertSame(['application' => ['x' => 'y']], $provider->getConfig());
    }
}
