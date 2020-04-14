<?php

use frontend\assets\IndexPageAsset;
use yii\helpers\Html;

/**
 * @var $this yii\web\View
 */

$this->title = Yii::$app->name;
IndexPageAsset::register($this);

?>
<div class="container">
    <div class="row">
        <?= Html::input(
            'url',
            'productUrl',
            null,
            ['class' => 'form-control', 'placeholder' => Yii::t('app', 'Введите URL товара')]
        ) ?>
        <?= Html::button(Yii::t('app', 'Добавить'), ['class' => 'btn btn-success', 'id' => 'addProduct']) ?>
    </div>
</div>
