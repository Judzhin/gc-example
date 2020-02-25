<?php declare(strict_types=1);

use Laminas\Log\Logger;
use Laminas\Log\LoggerInterface;
use Psr\Container\ContainerInterface;

chdir(__DIR__ . '/../');

require 'vendor/autoload.php';

/**
 * Self-called anonymous function that creates its own scope and keep the global namespace clean.
 */
(function () {
    /** @var ContainerInterface $container */
    $container = require 'config/container.php';

    /** @var LoggerInterface $logger */
    $logger = $container->get(Logger::class);
    $logger->info('[Cron] Process was run from a POD: ' . getenv('POD_IP'));
})();