<?php

namespace frontend\widgets;

use frontend\models\Product;
use yii\base\Widget;

/**
 * Class ProductImagesSlider
 * @package frontend\widgets
 */
class ProductImagesSlider extends Widget
{
    /** @var Product */
    public $product;

    /**
     * @return string
     */
    public function run()
    {
        return $this->render('images_slider', [
             'product' => $this->product
        ]);
    }
}
