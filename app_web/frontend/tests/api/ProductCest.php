<?php

namespace frontend\tests;

use Codeception\Util\HttpCode;
use common\fixtures\ProductFixture;

/**
 * Class ProductCest
 * @package frontend\tests
 */
class ProductCest
{
    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'product' => [
                'class' => ProductFixture::class,
                'dataFile' => codecept_data_dir() . 'product.php',
            ]
        ];
    }

    /**
     * @param ApiTester $I
     */
    public function testAddProductInvalidRequest(ApiTester $I)
    {
        $I->sendPOST('/products', ['url' => 'test']);

        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
    }

    /**
     * @param ApiTester $I
     */
    public function testAddProductValidRequest(ApiTester $I)
    {
        $I->sendPOST('/products', ['url' => 'https://www.wildberries.tk/catalog/123/detail.aspx?']);
        $I->seeResponseCodeIs(HttpCode::CREATED);
    }

    /**
     * @param ApiTester $I
     */
    public function testAddProductAlreadyExists(ApiTester $I)
    {
        $I->sendPOST('/products', ['url' => 'https://www.wildberries.ru/catalog/123/detail.aspx?']);
        $I->seeResponseCodeIs(HttpCode::CREATED);
    }
}
