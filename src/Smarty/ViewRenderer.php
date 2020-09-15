<?php

declare(strict_types=1);

namespace App\Smarty;

use Smarty;
use Yiisoft\View\View;
use Yiisoft\View\TemplateRendererInterface;

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
        $renderer = function () use ($view, $template, $params, $smarty) {
            $file = str_replace($view->getBasePath(), null, $template);
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
}
