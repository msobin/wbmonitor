<?php

namespace frontend\api\v1\controllers;

use common\models\Product;
use frontend\api\v1\actions\CreateProductAction;
use yii\rest\ActiveController;

/**
 * Class ProductController
 * @package frontend\api\v1\controllers
 */
class ProductController extends ActiveController
{
    public $modelClass = Product::class;

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete'], $actions['update'], $actions['options']);

        $actions['create']['class'] = CreateProductAction::class;

        return $actions;
    }
}
