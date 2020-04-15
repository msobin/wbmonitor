<?php

namespace frontend\models;

use NumberFormatter;
use Yii;
use yii\helpers\Url;

/**
 * Class Product
 * @package frontend\models
 *
 * @property string $uri
 * @property string $shopUrl
 * @property string $imageUrl
 * @property string $cardSizes
 * @property string $cardPrice
 * @property string $cardPricePrev
 */
class Product extends \common\models\Product
{
    /**
     * @return string
     */
    public function getUri()
    {
        return Url::to(['/product/view', 'id' => $this->id]);
    }

    /**
     * @return string
     */
    public function getShopUrl()
    {
        return Yii::$app->productService->buildUrl($this);
    }

    /**
     * @return mixed|string
     */
    public function getImageUrl()
    {
        return $this->images ? reset($this->images) : '#';
    }

    /**
     * @return string
     */
    public function getCardSizes()
    {
        return implode(', ', $this->sizes);
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getCardPrice()
    {
        return $this->getCardPriceAttribute('value');
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getCardPricePrev()
    {
        return $this->getCardPriceAttribute('value_prev');
    }

    /**
     * @param string $attribute
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getCardPriceAttribute(string $attribute)
    {
        return $this->price && $this->price->{$attribute}
            ? Yii::$app->formatter->asCurrency(
                $this->price->{$attribute},
                Yii::$app->productService->getProductCurrencyCode($this),
                [NumberFormatter::MAX_FRACTION_DIGITS => 0]
            )
            : '';
    }
}
