<?php

use frontend\models\Product;

/**
 * @var Product $model
 */
?>

<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="<?= $model->imageUrl ?>" style="max-width: 100px">
    <div class="card-body">
        <h5 class="card-title"><?= $model->name ?></h5>
        <p class="card-text"><?= $model->description ?></p>
    </div>
    <ul class="list-group list-group-flush">
        <?php if ($model->cardSizes) : ?>
            <li class="list-group-item"><?= $model->cardSizes ?></li>
        <?php endif; ?>
        <?php if ($model->price) : ?>
            <li class="list-group-item"><?= $model->cardPrice ?></li>
        <?php endif; ?>
    </ul>
    <div class="card-body">
        <a href="<?= $model->shopUrl ?>" target="_blank" class="btn btn-primary"><?= Yii::t('app', 'Промотр'); ?></a>
        <a href="<?= $model->uri ?>" target="_blank" class="btn btn-primary"><?= Yii::t('app', 'В магазин'); ?></a>
    </div>
</div>
