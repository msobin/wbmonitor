<?php

use frontend\api\models\Product;
use frontend\widgets\ProductPriceChart;

/**
 * @var Product $product
 */
?>

<?= ProductPriceChart::widget(['product' => $product]) ?>