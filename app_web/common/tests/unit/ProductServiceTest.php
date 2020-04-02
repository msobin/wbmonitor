<?php

namespace common\tests;

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
     * @return void
     */
    protected function _after()
    {
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
        $this->productService->parseProductUrl(
            'http://www.wildberries.tk/catalog/123/detail.aspx?'
        );
    }
}
