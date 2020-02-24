<?php declare(strict_types=1);
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace App\Handler;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;

/**
 * Class HomePageHandlerFactory
 * @package App\Handler
 */
class HomePageHandlerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return HomePageHandler
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): HomePageHandler
    {
        return new HomePageHandler(
            $container->get(RouterInterface::class), $container->get(TemplateRendererInterface::class)
        );
    }
}
