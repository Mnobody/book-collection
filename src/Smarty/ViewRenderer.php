<?php

declare(strict_types=1);

namespace App\Smarty;

use App\Asset\AppAsset;
use App\Asset\CdnFontAwesomeAsset;
use App\Widget\FlashMessage;
use Smarty;
use Yiisoft\Html\Html;
use Yiisoft\View\View;
use Yiisoft\View\TemplateRendererInterface;
use Yiisoft\Yii\Bootstrap5\Nav;
use Yiisoft\Yii\Bootstrap5\NavBar;

final class ViewRenderer implements TemplateRendererInterface
{
    private Smarty $smarty;

    public function __construct(Smarty $smarty)
    {
        $this->smarty = $smarty;
    }

    public function render(View $view, string $template, array $params): string
    {
        $smarty = $this->smarty;
        $classes = $this->layoutClassesToRegister();
        $renderer = function () use ($view, $template, $params, $smarty, $classes) {
            $file = str_replace($view->getBasePath(), null, $template);

            $params = array_merge(['classes' => $classes, 'view' => $view], $params);

            foreach ($params as $key => $param) {
                if ($key === 'classes') {
                    foreach ($param as $name => $namespace) {
                        $smarty->registerClass($name, $namespace);
                    }
                } else {
                    $smarty->assign($key, $param);
                }
            }

            echo $smarty->display($file);
        };

        $obInitialLevel = ob_get_level();
        ob_start();
        ob_implicit_flush(0);
        try {
            $renderer->bindTo($view)($template, $params);
            return ob_get_clean();
        } catch (\Throwable $e) {
            while (ob_get_level() > $obInitialLevel) {
                if (!@ob_end_clean()) {
                    ob_clean();
                }
            }
            throw $e;
        }
    }

    private function layoutClassesToRegister(): array
    {
        return [
            'AppAsset' => AppAsset::class, 'CdnFontAwesomeAsset' => CdnFontAwesomeAsset::class,
            'Html' => Html::class, 'NavBar' => NavBar::class, 'Nav' => Nav::class,
            'FlashMessage' => FlashMessage::class,
        ];
    }
}
