<?php

declare(strict_types=1);

namespace App\Asset;

use Yiisoft\Assets\AssetBundle;

final class JqueryAsset extends AssetBundle
{
    public bool $cdn = true;

    public array $js = [
        'https://code.jquery.com/jquery-3.5.1.min.js'
    ];
}
