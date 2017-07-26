# ZF External Config - Consul Provider

This library contains provider that can fetch configuration from Consul Key/Value Storage.

## Installation

Require module with Composer:

```bash
composer require rstgroup/zf-external-config-consul-provider
```

Then don't forget to enable provider and define factory in the `zf-config-module`'s 
section of application's configuration:

```php
return [
    'rst_group' => [
        'external_config' => [
            'providers' => [
                \RstGroup\ZfExternalConfigConsulProvider\ConsulConfigProvider::class,
            ],
            'service_manager' => [
                'factories' => [
                    \RstGroup\ZfExternalConfigConsulProvider\ConsulConfigProvider::class => 
                        \RstGroup\ZfExternalConfigConsulProvider\ConsulConfigProviderFactory::class
                ]
            ]
        ],
    ]
];
```

## Configuration

Example configuration of provider might look just like this:

```php
return [
    'rst_group' => [
        'external_config' => [
            'consul' => [
                'prefix' => 'my-app/',
                'http_client' => [
                    'base_uri' => 'http://consul.local:8500',
                ]
            ],
        ],
    ],
];
```

The provider's configuration should be placed under `rsr_group.external_config.consul` key.
There are two sections:

1. `prefix` key, which determines the base path in Consul's KV Storage. How it exactly works
  you can read in 
  [`rstgroup/php-consul-kv-array-getter`'s documentation](https://github.com/rstgroup/php-consul-kv-array-getter).
  <br /> If you don't provide `prefix`, provider will return all keys returned by Consul KV API. 
2. `http_client` key, which contains options passed to `GuzzleHttp\Client` instance. The key that
  should interest you is `base_uri` which determines the base location of Consul's API. By default it's value is
  `http://127.0.0.1:8500`. <br />
  More information about possible options are described in [Guzzle Docs](http://docs.guzzlephp.org/en/stable/overview.html)
  and in [Guzzle's repository](https://github.com/guzzle/guzzle/tree/6.3.0). 
