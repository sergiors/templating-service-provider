<?php
namespace Inbep\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\DelegatingEngine;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Bridge\Twig\TwigEngine;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
class TemplatingServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['templating.path'] = [];

        $app['templating.name_parser'] = $app->share(function () {
            return new TemplateNameParser();
        });

        $app['templating.loader'] = $app->share(function (Application $app) {
            return new FilesystemLoader($app['templating.path']);
        });

        $app['templating'] = $app->share(function (Application $app) {
            $engines = [
                new PhpEngine($app['templating.name_parser'], $app['templating.loader'])
            ];

            if (isset($app['twig']) && class_exists('Symfony\Bridge\Twig\TwigEngine')) {
                $engines[] = new TwigEngine($app['twig'], $app['templating.name_parser']);
            }

            return new DelegatingEngine($engines);
        });
    }

    public function boot(Application $app)
    {
    }
}
