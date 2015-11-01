<?php
namespace Sergiors\Silex\Provider;

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
        $app->register(new TemplatingServiceProvider());
        $this->assertInstanceOf(EngineInterface::class, $app['templating']);
    }

    /**
     * @test
     */
    public function shouldReturnContentOfPhpView()
    {
        $app = $this->createApplication();
        $app->register(new TemplatingServiceProvider());
        $app['templating.paths'] = [__DIR__.'/../Resources/views/%name%'];

        $expected = "<h1>Hello Sérgio!</h1>\n";
        $rendered = $app['templating']->render('hello.php', [
            'name' => 'Sérgio'
        ]);
        $this->assertEquals($rendered, $expected);
    }

    /**
     * @test
     */
    public function shouldReturnContentOfTwigView()
    {
        $app = $this->createApplication();
        $app->register(new TwigServiceProvider(), [
            'twig.path' => __DIR__.'/../Resources/views'
        ]);
        $app->register(new TemplatingServiceProvider());

        $expected = "<h1>Hello Sérgio!</h1>\n";
        $rendered = $app['templating']->render('hello.html.twig', [
            'name' => 'Sérgio'
        ]);
        $this->assertEquals($rendered, $expected);
    }

    public function createApplication()
    {
        $app = new Application();
        $app['debug'] = true;
        $app['exception_handler']->disable();
        return $app;
    }
}
