<?php

namespace frontend\api\modules\v1\actions;

use common\services\exceptions\ProductServiceException;
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
     * @throws ConflictHttpException
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
        } catch (ConflictHttpException $e) {
            throw $e;
        } catch (ProductServiceException $e) {
            if ($e->getCode() == ProductServiceException::CODE_INTERNAL_ERROR) {
                throw new ServerErrorHttpException();
            } else {
                throw new BadRequestHttpException($e->getMessage());
            }
        } catch (\Exception $e) {
            throw new ServerErrorHttpException($e->getMessage());
        }

        $response = Yii::$app->getResponse();
        $response->setStatusCode(201);
        $response->getHeaders()->set('Location', Url::toRoute([$this->viewAction, 'id' => $model->id], true));

        return $model;
    }
}
