<?php

declare(strict_types=1);

namespace App\Widget;

use Yiisoft\Session\Flash\Flash;

final class FlashMessage extends \Yiisoft\Widget\Widget
{
    private Flash $flash;

    public function __construct(Flash $flash)
    {
        $this->flash = $flash;
    }

    public function run(): string
    {
        $flashes = $this->flash->getAll();
        $html = '';

        foreach ($flashes as $type => $data) {
            foreach ($data as $message) {
                $html .= Message::widget()
                    ->body($message['body'] ?? '')
                    ->type($type)
                    ->render();
            }
        }

        return $html;
    }
}
