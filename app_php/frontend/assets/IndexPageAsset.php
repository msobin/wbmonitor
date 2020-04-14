<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Class IndexPageAsset
 * @package frontend\assets
 */
class IndexPageAsset extends AssetBundle
{
    public $js = [
        'js/index-page.js',
    ];

    public $depends = [
        AppAsset::class,
    ];

    // todo удалить полсе отладки
    public $publishOptions = [
        'forceCopy' => true,
    ];
}
