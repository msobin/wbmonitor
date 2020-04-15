<?php

namespace frontend\controllers;

use common\services\exceptions\ProductServiceException;
use frontend\models\Product;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AjaxFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
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
    public function actionAdd(string $url)
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

    /**
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(int $id)
    {
        $product = $this->getProduct($id);

        return $this->render('view', [
            'product' => $product,
        ]);
    }

    /**
     * @param int $id
     * @return Product
     * @throws NotFoundHttpException
     */
    protected function getProduct(int $id)
    {
        if (!$product = Product::findOne($id)) {
            throw new NotFoundHttpException(Yii::t('app', 'Товар не найден'));
        };

        return $product;
    }
}
