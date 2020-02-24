<?php

declare(strict_types=1);

use Laminas\ConfigAggregator\ConfigAggregator;

return [
    // Toggle the configuration cache. Set this to boolean false, or remove the
    // directive, to disable configuration caching. Toggling development mode
    // will also disable it by default; clear the configuration cache using
    // `composer clear-config-cache`.
    ConfigAggregator::ENABLE_CACHE => true,

    // Enable debugging; typically used to provide debugging information within templates.
    'debug' => false,

    'mezzio' => [
        // Provide templates for the error handling middleware to use when
        // generating responses.
        'error_handler' => [
            'template_404'   => 'error::404',
            'template_error' => 'error::error',
        ],
    ],

    'log' => [
        'writers' => [
            'stream' => [
                'name' => \Laminas\Log\Writer\Stream::class,
                'options' => [
                    'stream' => "./data/log/errors.log",
                    'mode' => 'a+',
                    'formatter' => [
                        'name' => \Laminas\Log\Formatter\Simple::class,
                        'options' => [
                            'format' => '%timestamp% %priorityName% (%priority%): %message% %extra%',
                            'dateTimeFormat' => 'c', // 'Y-m-d H:i:s',
                        ],
                    ],
                    'filters' => [
                        'priority' => [
                            'name' => \Laminas\Log\Filter\Priority::class,
                            'options' => [
                                'priority' => \Laminas\Log\Logger::ERR,
                            ],
                        ],
                    ],
                ],
            ],
        ]
    ],
];
