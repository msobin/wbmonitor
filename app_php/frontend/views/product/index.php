<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use frontend\models\Product;
use yii\helpers\Html;

/**
 * @var ActiveDataProvider $dataProvider
 */

?>

<?php try {
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'content' => function (Product $product) {
                    return Html::a('#' . $product->id, $product->getUri());
                }
            ],
            'name'
        ],
    ]);
} catch (Exception $e) {
} ?>
