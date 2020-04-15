<?php

namespace common\models;

use DateTime;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Class Product
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
 * @property Brand $brand
 * @property Category $category
 * @property ProductPrice $price
 * @property ProductPriceHistory[] $priceHistory
 */
class Product extends ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_SATELLITE = 2;
    const STATUS_REGULAR = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
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
            [['domain', 'code'], 'required'],
            ['status', 'default', 'value' => self::STATUS_NEW],
            ['ref_count', 'default', 'value' => 0],
            [['domain', 'name'], 'string', 'max' => 255],
            [['code', 'status', 'ref_count'], 'integer'],
            ['category_ids', 'each', 'rule' => 'integer'],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriceHistory()
    {
        return $this->hasMany(ProductPriceHistory::class, ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrice()
    {
        return $this->hasOne(ProductPrice::class, ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::class, ['id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_ids']);
    }
}
