<?php

use frontend\models\Product;

/**
 * @var Product $model
 */
?>

<div class="card product-card" style="width: 24rem;">
    <div class="card-img-top" style="text-align: center">
        <img class="card-img-top img-responsive" src="<?= $model->imageUrl ?>">
    </div>
    <div class="card-body">
        <h5 class="card-title"><?= $model->name ?></h5>
<!--        <p class="card-text">--><?//= $model->description ?><!--</p>-->
    </div>
    <ul class="list-group list-group-flush">
        <?php if ($model->cardSizes) : ?>
            <li class="list-group-item"><?= $model->cardSizes ?></li>
        <?php endif; ?>
        <?php if ($model->price) : ?>
            <?php
            switch ($model->priceChangeDirection()) {
                case -1:
                    $priceColor = 'LightGreen';
                    break;
                case 1:
                    $priceColor = 'LightSalmon';
                    break;
                case 0:
                    $priceColor = '';
                    break;
            } ?>
            <li class="list-group-item"
                style="background-color: <?= $priceColor ?>"><?= implode(' -> ', [$model->cardPricePrev, $model->cardPrice]) ?></li>
        <?php endif; ?>
    </ul>
    <div class="card-body">
        <a href="<?= $model->uri ?>" target="_blank" class="btn btn-primary"><?= Yii::t('app', 'Промотр'); ?></a>
        <a href="<?= $model->shopUrl ?>" target="_blank" class="btn btn-primary"><?= Yii::t('app', 'В магазин'); ?></a>
    </div>
</div>
