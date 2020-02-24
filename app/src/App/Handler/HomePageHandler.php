<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
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
    /** @var Router\RouterInterface */
    private $router;

    /** @var null|TemplateRendererInterface */
    private $template;

    /**
     * HomePageHandler constructor.
     *
     * @param Router\RouterInterface $router
     * @param TemplateRendererInterface|null $template
     */
    public function __construct(Router\RouterInterface $router, ?TemplateRendererInterface $template = null)
    {
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
        /** @var array $data */
        $data = ArrayUtils::merge([
            'title' => new \DateTime,
        ], getenv());

        if ($this->template === null) {
            return new JsonResponse($data);
        }

        return new HtmlResponse($this->template->render('app::home-page', $data));
    }
}
