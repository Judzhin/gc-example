<?php declare(strict_types=1);
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace App\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function time;

/**
 * Class PingHandler
 * @package App\Handler
 */
class PingHandler implements RequestHandlerInterface
{
    /**
     * @inheritDoc
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        return new JsonResponse(['ack' => time()]);
    }
}
