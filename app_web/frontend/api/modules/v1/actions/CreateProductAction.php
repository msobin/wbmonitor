<?php

namespace frontend\api\modules\v1\actions;

use Yii;
use yii\helpers\Url;
use yii\rest\CreateAction;
use yii\web\ConflictHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Class CreateProductAction
 */
class CreateProductAction extends CreateAction
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        $url = Yii::$app->getRequest()->getBodyParam('url');

        try {
            $model = Yii::$app->productService->getProductByUrl($url);

            if ($model) {
                throw new ConflictHttpException('Product already exists');
            }

            $model = Yii::$app->productService->addProduct($url);
            $model->refresh();
        } catch (\Exception $e) {
            throw new ServerErrorHttpException('Error occured');
        }

        $response = Yii::$app->getResponse();
        $response->setStatusCode(201);
        $id = implode(',', array_values($model->getPrimaryKey(true)));

        $response->getHeaders()->set('Location', Url::toRoute([$this->viewAction, 'id' => $id], true));

        return $model;
    }
}
