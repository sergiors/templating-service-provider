<?php
namespace Inbep\Silex\Provider;

use Silex\Application;
use Silex\WebTestCase;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\Templating\EngineInterface;

class TemplatingServiceProviderTest extends WebTestCase
{
    /**
     * @test
     */
    public function register()
    {
        $app = $this->createApplication();
        $app->register(new TwigServiceProvider());
        $app->register(new TemplatingServiceProvider());
        $this->assertInstanceOf(EngineInterface::class, $app['templating']);
    }

    public function createApplication()
    {
        $app = new Application();
        $app['debug'] = true;
        $app['exception_handler']->disable();
        return $app;
    }
}
