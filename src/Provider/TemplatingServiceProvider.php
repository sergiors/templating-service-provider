<?php

namespace Sergiors\Silex\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
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
    public function register(Container $app)
    {
        $app['templating.name_parser'] = function () {
            return new TemplateNameParser();
        };

        $app['templating.loader'] = function (Container $app) {
            $loader = new FilesystemLoader($app['templating.paths']);

            if (isset($app['logger'])) {
                $loader->setLogger($app['logger']);
            }

            return $loader;
        };

        $app['templating'] = function (Container $app) {
            $engines = [
                new PhpEngine($app['templating.name_parser'], $app['templating.loader']),
            ];

            if (isset($app['twig']) && class_exists('Symfony\Bridge\Twig\TwigEngine')) {
                $engines[] = new TwigEngine($app['twig'], $app['templating.name_parser']);
            }

            return new DelegatingEngine($engines);
        };

        $app['templating.paths'] = [];
    }
}
