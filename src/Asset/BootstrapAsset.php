<?php

declare(strict_types=1);

namespace App\Asset;

use Yiisoft\Yii\Bootstrap5\Assets\BootstrapAsset as BaseBootstrapAsset;

final class BootstrapAsset extends BaseBootstrapAsset
{
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';
}
