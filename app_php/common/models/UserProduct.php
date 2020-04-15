<?php

namespace common\models;

use DateTime;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Class UserProduct
 * @package common\models
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class UserProduct extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_product';
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
            [['user_id', 'product_id'], 'required'],
            [
                'user_id',
                'exist',
                'targetClass' => User::class,
                'targetAttribute' => ['user_id' => 'id']
            ],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}