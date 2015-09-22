Templating Service Provider
---------------------------
A service to help you with template engine implementation using PHP or Twig.

Install
-------
```bash
composer require inbep/templating-service-provider
```

```php
$app->register(Inbep\Silex\Provider\TemplatingServiceProvider(), [
    'templating.paths' => '__DIR__.'/../Resources/views/%name%' // or an array
]);

$app['templating']->render(/.../);
```

If you want to use Twig:
```php
$app->register(Silex\Provider\TwigServiceProvider(), [
    'twig.path' => __DIR__.'/../Resources/views'
]);
$app->register(Inbep\Silex\Provider\TemplatingServiceProvider());

$app['templating']->render(/.../);
```

Don't forget to install `twig/twig` and `symfony/twig-bridge` to use the Twig.

License
-------
MIT
