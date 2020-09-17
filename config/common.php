<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Session\Session;
use Yiisoft\Session\SessionInterface;

/* @var array $params */

return [
    ContainerInterface::class => static function (ContainerInterface $container) {
        return $container;
    },

    Aliases::class => [
        '__class' => Aliases::class,
        '__construct()' => [$params['aliases']],
    ],

    SessionInterface::class => [
        '__class' => Session::class,
        '__construct()' => [
            $params['yiisoft/yii-web']['session']['options'] ?? [],
            $params['yiisoft/yii-web']['session']['handler'] ?? null,
        ],
    ],
];
