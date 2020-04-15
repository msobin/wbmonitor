<?php

use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

/**
 * @var ActiveDataProvider $dataProvider
 */

?>

<?php try {
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_product',
    ]);
} catch (Exception $e) {
    throw $e;
} ?>
