<?php declare(strict_types=1);

/**
 * @see       https://github.com/mezzio/mezzio-skeleton for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-skeleton/blob/master/LICENSE.md New BSD License
 */

use Laminas\Log\Logger;
use Laminas\Log\LoggerInterface;
use Psr\Container\ContainerInterface;

chdir(__DIR__ . '/../');

require 'vendor/autoload.php';

// $config = include 'config/config.php';

/**
 * Self-called anonymous function that creates its own scope and keep the global namespace clean.
 */
(function () {
    /** @var ContainerInterface $container */
    $container = require 'config/container.php';

    /** @var array $config */
    $config = $container->get('config');

    /** @var LoggerInterface $logger */
    $logger = $container->get(Logger::class);

    if (! isset($config['config_cache_path'])) {
        $logger->info('No configuration cache path found');
        exit(0);
    }

    if (! file_exists($config['config_cache_path'])) {
        $logger->info(sprintf(    "[Job] Configured config cache file '%s' not found", $config['config_cache_path']));
        exit(0);
    }

    if (false === unlink($config['config_cache_path'])) {
        $logger->info(sprintf(    "[Job] Error removing config cache file '%s'", $config['config_cache_path']));
        exit(1);
    }

    $logger->info(sprintf(    "[Job] Removed configured config cache file '%s'", $config['config_cache_path']));
})();

exit(0);
