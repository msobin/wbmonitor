<?php

namespace frontend\controllers;

use common\services\exceptions\ProductServiceException;
use Yii;
use yii\filters\AjaxFilter;
use yii\web\Controller;
use yii\web\Response;

/**
 * Class ProductController
 * @package frontend\controllers
 */
class ProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => AjaxFilter::class,
                'only' => ['add-product']
            ],
        ];
    }

    /**
     * @param string $url
     * @return array
     */
    public function actionAddProduct(string $url)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            Yii::$app->productService->addProduct($url);
        } catch (ProductServiceException $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }

        return [
            'success' => true,
            'message' => Yii::t('app', 'Товар добавлен'),
        ];
    }
}
