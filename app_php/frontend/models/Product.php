<?php

namespace frontend\models;

use yii\helpers\Url;

/**
 * Class Product
 * @package frontend\models
 */
class Product extends \common\models\Product
{
    /**
     * @return string
     */
    public function getUri()
    {
        return Url::to(['/product/view', 'id' => $this->id]);
    }
}
