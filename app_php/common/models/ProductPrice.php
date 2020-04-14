<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use DateTime;

/**
 * Class ProductPrice
 * @package common\models
 *
 * @property int $id
 * @property int $product_id
 * @property int $value
 * @property int $prev_value
 * @property int $status
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @property Product $product
 */
class ProductPrice extends ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_PROCESSED = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_price';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'value', 'status'], 'required'],
            ['status', 'default', 'value' => self::STATUS_NEW],
            [['product_id', 'value', 'prev_value', 'status'], 'integer'],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}
