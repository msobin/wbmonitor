<?php

namespace frontend\widgets;

use common\models\ProductPriceHistory;
use frontend\models\Product;
use yii\base\Widget;
use Yii;

/**
 * Class ProductPriceChart
 * @package frontend\widgets
 */
class ProductPriceChart extends Widget
{
    /** @var Product */
    public $product;

    /**
     * {@inheritdoc}
     * @throws \yii\base\InvalidConfigException
     */
    public function run()
    {
        return $this->render('price_chart', [
            'dataset' => $this->prepareDataset(),
        ]);
    }

    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    protected function prepareDataset()
    {
        $dataset = [
            'labels' => [],
            'data' => [],
        ];

        $prices = $this->product->getPriceHistory()
            ->orderBy('id DESC')
            ->limit(30)
            ->all();

        /** @var ProductPriceHistory $price */
        foreach ($prices as $price) {
            $dataset['labels'][] = Yii::$app->formatter->asDate($price->created_at);
            $dataset['data'][] = $price->value;
        }

        return $dataset;
    }
}
