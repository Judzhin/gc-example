<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Log\LoggerInterface;
use Laminas\Stdlib\ArrayUtils;
use Mezzio\Router;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class HomePageHandler
 * @package App\Handler
 */
class HomePageHandler implements RequestHandlerInterface
{
    /** @var LoggerInterface */
    private $logger;

    /** @var Router\RouterInterface */
    private $router;

    /** @var null|TemplateRendererInterface */
    private $template;

    /**
     * HomePageHandler constructor.
     *
     * @param LoggerInterface $logger
     * @param Router\RouterInterface $router
     * @param TemplateRendererInterface|null $template
     */
    public function __construct(LoggerInterface $logger, Router\RouterInterface $router, ?TemplateRendererInterface $template = null)
    {
        $this->logger = $logger;
        $this->router = $router;
        $this->template = $template;
    }

    /**
     * @inheritDoc
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \Exception
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->logger->err(sprintf('Write Log From POD: %s', getenv('POD_IP')));

        /** @var array $data */
        $data = ArrayUtils::merge([
            'title' => 'Hello Google Cloud Example!',
        ], getenv());

        if (null === $this->template) {
            return new JsonResponse($data);
        }

        return new HtmlResponse($this->template->render('app::home-page', $data));
    }
}
