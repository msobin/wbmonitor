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
 * @property string $domain
 * @property string $code
 * @property string $name
 * @property integer $status
 * @property array $images
 * @property array $picker
 * @property array $sizes
 * @property array $categories_ids
 * @property integer $ref_count
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
