<?php

declare(strict_types=1);

use App\ApplicationParameters;
use Yiisoft\Validator\ValidatorFactory;
use Yiisoft\Validator\ValidatorFactoryInterface;
use App\View\ViewRenderer;

/* @var array $params */

return [
    ApplicationParameters::class => static function () use ($params) {
        return (new ApplicationParameters())
            ->charset($params['app']['charset'])
            ->language($params['app']['language'])
            ->name($params['app']['name']);
    },

    ValidatorFactoryInterface::class => ValidatorFactory::class,

    ViewRenderer::class => [
        '__construct()' => [
            'viewBasePath' => $params['yiisoft/yii-view']['viewBasePath'],
            'layout' => $params['yiisoft/yii-view']['layout'],
            'injections' => $params['yiisoft/yii-view']['injections'],
        ],
    ],

    Smarty::class => static function(Psr\Container\ContainerInterface $container) {
        $alias = $container->get(Yiisoft\Aliases\Aliases::class);

        return (new Smarty)
            ->setCacheDir($alias->get('@runtime/smarty/cache'))
            ->setCompileDir($alias->get('@runtime/smarty/compile'))
            ->setTemplateDir($alias->get('@views'));
    },
];
