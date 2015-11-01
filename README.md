Templating Service Provider
---------------------------
A service to help you with template engine implementation using PHP or Twig.

Install
-------
```bash
composer require sergiors/templating-service-provider
```

```php
use Sergiors\Silex\Provider\TemplatingServiceProvider;

$app->register(new TemplatingServiceProvider(), [
    'templating.paths' => '__DIR__.'/../Resources/views/%name%' // or an array
]);

$app['templating']->render(/.../);
```

If you want to use Twig:
```php
use Silex\Provider\TwigServiceProvider;
use Sergiors\Silex\Provider\TemplatingServiceProvider;

$app->register(new TwigServiceProvider(), [
    'twig.path' => __DIR__.'/../Resources/views'
]);
$app->register(new TemplatingServiceProvider());

$app['templating']->render(/.../);
```

Don't forget to install `twig/twig` and `symfony/twig-bridge` to use the Twig.

License
-------
MIT
