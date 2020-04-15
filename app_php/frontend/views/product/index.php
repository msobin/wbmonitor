<?php

use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

/**
 * @var ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('app', 'Товары');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php try {
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_product',
    ]);
} catch (Exception $e) {
    throw $e;
} ?>
