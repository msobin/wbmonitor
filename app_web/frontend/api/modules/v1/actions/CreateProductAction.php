<?php

namespace frontend\api\modules\v1\actions;

use common\services\exceptions\PSException;
use Yii;
use yii\helpers\Url;
use yii\rest\CreateAction;
use yii\web\BadRequestHttpException;
use yii\web\ConflictHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Class CreateProductAction
 */
class CreateProductAction extends CreateAction
{
    /**
     * {@inheritdoc}
     * @throws BadRequestHttpException
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
        } catch (PSException $e) {
            if ($e->getCode() == PSException::CODE_INTERNAL_ERROR) {
                throw new ServerErrorHttpException();
            } else {
                throw new BadRequestHttpException($e->getMessage());
            }
        } catch (\Exception $e) {
            throw new ServerErrorHttpException($e->getMessage());
        }

        $response = Yii::$app->getResponse();
        $response->setStatusCode(201);
        $id = implode(',', array_values($model->getPrimaryKey(true)));

        $response->getHeaders()->set('Location', Url::toRoute([$this->viewAction, 'id' => $id], true));

        return $model;
    }
}
