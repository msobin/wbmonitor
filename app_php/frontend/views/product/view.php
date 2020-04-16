<?php

use frontend\models\Product;
use frontend\widgets\ProductPriceChart;
use frontend\widgets\ProductImagesSlider;

/**
 * @var Product $product
 */
?>

<h1><?= $product->fullName ?></h1>
<div class="row">
    <div class="col-md-4">
        <?= ProductImagesSlider::widget(['product' => $product]) ?>
    </div>
    <div class="col-md-8">
        <?= $product->cardPrice ?>
        <a href="<?= $model->shopUrl ?>" target="_blank" class="btn btn-primary"><?= Yii::t('app', 'В магазин'); ?></a>
    </div>
</div>
<div class="col-md-12">
    <?= ProductPriceChart::widget(['product' => $product]) ?>
</div>
