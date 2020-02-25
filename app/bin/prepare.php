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
    $logger->info(sprintf('[Job] Prepare project pod "%s" before work.', getenv('POD_IP')));
    $logger->info('- Run migrations');
    $logger->info('- Update cache');
    $logger->info('- And something more');
})();