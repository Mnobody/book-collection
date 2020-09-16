<?php

declare(strict_types=1);

namespace App\Asset;

use Yiisoft\Assets\AssetBundle;

final class JqueryUIAsset extends AssetBundle
{
    public bool $cdn = true;

    public array $css = [
        'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'
    ];

    public array $js = [
        'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js'
    ];

    public array $depends = [
        JqueryAsset::class
    ];
}
