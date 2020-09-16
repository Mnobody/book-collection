<?php

declare(strict_types=1);

namespace App\Widget;

use Yiisoft\Yii\DataView\ListView as BaseListView;

final class ListView extends BaseListView
{
    protected function formatMessage(string $message, array $arguments = []): string
    {
        // translation doesnt work correctly, so hide summary for now
        return '';
    }
}
