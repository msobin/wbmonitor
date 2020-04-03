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
     * @throws \common\services\exceptions\PSException
     */
    public function testParseUrlSuccess()
    {
        $result = $this->productService->parseProductUrl(
            'https://www.wildberries.tk/catalog/123/detail.aspx?'
        );

        $this->assertArrayHasKey('domain', $result);
        $this->assertArrayHasKey('code', $result);
        $this->assertEquals('tk', $result['domain']);
        $this->assertEquals(123, $result['code']);
    }

    /**
     * @expectedException \common\services\exceptions\PSException
     */
    public function testParseUrlException()
    {
        $this->productService->parseProductUrl('xxx://www.wildberries.tk/catalog/123/detail.aspx?');
    }

    /**
     * @return void
     * @throws \common\services\exceptions\PSException
     */
    public function testGetProductByUrl()
    {
        $product = $this->productService->getProductByUrl('https://www.wildberries.kz/catalog/123/detail.aspx?');

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals(123, $product->code);
        $this->assertEquals('kz', $product->domain);
    }

    /**
     * @return void
     */
    public function testGetProductByCode()
    {
        $product = $this->productService->getProductByCode('ru', 123);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals(123, $product->code);
        $this->assertEquals('ru', $product->domain);
    }

    /**
     * @return void
     * @throws \common\services\exceptions\PSException
     */
    public function testAddProduct()
    {
        $product = $this->productService->addProduct('https://www.wildberries.tk/catalog/123/detail.aspx?');

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals(123, $product->code);
        $this->assertEquals('tk', $product->domain);
    }
}
