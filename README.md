# ElasticsearchServiceProvider

[Elasticsearch Client](https://github.com/elasticsearch/elasticsearch-php) Service Provider for [Silex](https://github.com/silexphp/Silex) PHP framework.

## Installation

```json
{
    "require": {
        "symfonyx/elasticsearch-service-provider": "dev-master"
    }
}
```


## Usage

```php
use Silex\Application;
use xmarcos\Silex\ElasticsearchServiceProvider

$app = new Application();
$app['elasticsearch.params'] = [
    'hosts' => [
        'localhost:9200'
    ]
];
$app->register(new ElasticsearchServiceProvider('elasticsearch'));

$app['elasticsearch']->ping();
```

## License

MIT License
