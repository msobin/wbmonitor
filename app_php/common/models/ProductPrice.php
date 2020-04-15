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
 * @property integer $id
 * @property integer $product_id
 * @property integer $value
 * @property integer $value_prev
 * @property integer $status
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
            [['product_id', 'status'], 'required'],
            ['status', 'default', 'value' => self::STATUS_NEW],
            [['value', 'value_prev', 'status'], 'integer'],
            [
                'product_id',
                'exist',
                'targetClass' => Product::class,
                'targetAttribute' => ['product_id' => 'id']
            ],
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
