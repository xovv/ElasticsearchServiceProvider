<?php

namespace Xovv\Silex;

use InvalidArgumentException;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Elasticsearch\ClientBuilder;

/**
 * Silex Elasticsearch component Provider.
 * @package Xovv\Silex
 */
class ElasticsearchServiceProvider implements ServiceProviderInterface
{
    /** @var string */
    protected $prefix;

    /**
     * @param string $prefix Prefix name used to register the service provider in Silex.
     */
    public function __construct($prefix = 'elasticsearch')
    {
        if (empty($prefix)) {
            throw new InvalidArgumentException('The specified prefix is not valid.');
        }

        $this->prefix = $prefix;
    }

    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $prefix = $this->prefix;

        $app["$prefix.default_params"] = [
            'hosts' => [
                'localhost:9200'
            ],
            'retries' => 2,
            'handler' => ClientBuilder::singleHandler()
        ];

        $app["$prefix.params"] = !empty($app["$prefix.params"])
            ? array_merge($app["$prefix.default_params"], $app["$prefix.params"])
            : $app["$prefix.default_params"];

        $app["$prefix"] = function ($app) use ($prefix) {
            // Set $quiet to true to ignore the unknown param keys
            return ClientBuilder::fromConfig($app["$prefix.params"], true);
        };
    }
}
