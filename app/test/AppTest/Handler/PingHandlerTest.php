<?php

declare(strict_types=1);

namespace AppTest\Handler;

use App\Handler\PingHandler;
use Laminas\Diactoros\Response\JsonResponse;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class PingHandlerTest
 * @package AppTest\Handler
 */
class PingHandlerTest extends TestCase
{
    public function testResponse()
    {
        /** @var RequestHandlerInterface $pingHandler */
        $pingHandler = new PingHandler;

        /** @var ResponseInterface $response */
        $response = $pingHandler->handle(
            $this->prophesize(ServerRequestInterface::class)->reveal()
        );

        /** @var \stdClass $json */
        $json = json_decode((string) $response->getBody());

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertTrue(isset($json->ack));
    }
}
