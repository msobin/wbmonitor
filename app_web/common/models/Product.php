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
 */
class Product extends ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_REGULAR = 2;

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
            ['categories_ids', 'each', 'rule' => 'integer'],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
