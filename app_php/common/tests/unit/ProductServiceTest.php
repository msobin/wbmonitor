<?php

namespace common\tests;

use common\fixtures\ProductFixture;
use common\models\Product;
use common\services\ProductService;

/**
 * Class ProductServiceTest
 * @package common\tests
 */
class ProductServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->productService = new ProductService();
    }

    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'product' => [
                'class' => ProductFixture::class,
                'dataFile' => codecept_data_dir() . 'product.php'
            ]
        ];
    }

    /**
     * @throws \common\services\exceptions\ProductServiceException
     */
    public function testParseUrlSuccess()
    {
        $result = $this->productService->parseProductUrl(
            'https://www.wildberries.tk/catalog/123/detail.aspx?'
        );

        expect($result)->hasKey('domain');
        expect($result)->hasKey('code');
        expect($result['domain'])->equals('tk');
        expect($result['code'])->equals('123');
    }

    /**
     * @expectedException \common\services\exceptions\ProductServiceInvalidUrlException
     */
    public function testParseUrlException()
    {
        $this->productService->parseProductUrl('xxx://www.wildberries.tk/catalog/123/detail.aspx');
    }

    /**
     * @return void
     * @throws \common\services\exceptions\ProductServiceException
     */
    public function testGetProductByUrl()
    {
        $product = $this->productService->getProductByUrl('https://www.wildberries.kz/catalog/123/detail.aspx');

        expect($product)->isInstanceOf(Product::class);
        expect($product->domain)->equals('tk');
        expect($product->code)->equals('123');
    }

    /**
     * @return void
     */
    public function testGetProductByCode()
    {
        $product = $this->productService->getProductByCode('ru', 123);

        expect($product)->isInstanceOf(Product::class);
        expect($product->domain)->equals('ru');
        expect($product->code)->equals('123');
    }

    /**
     * @return void
     * @throws \common\services\exceptions\ProductServiceException
     */
    public function testAddProduct()
    {
        $product = $this->productService->addProduct('https://www.wildberries.tk/catalog/123/detail.aspx');

        expect($product)->isInstanceOf(Product::class);
        expect($product->domain)->equals('tk');
        expect($product->code)->equals('123');
    }

    public function testBuldUrl()
    {
        $product = new Product(['domain' => 'ru', 'code' => '1234']);
        $url = $this->productService->buildUrl($product);

        expect($url)->equals('https://www.wildberries.ru/catalog/1234/detail.aspx');
    }
}
