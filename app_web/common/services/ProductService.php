<?php

namespace common\services;

use common\models\Product;
use common\services\exceptions\PSException;
use yii\base\Component;

/**
 * Class ProductService
 * @package common\services
 */
class ProductService extends Component
{
    /**
     * @param string $url
     * @return Product
     * @throws PSException
     */
    public function addProduct(string $url)
    {
        $result = $this->parseProductUrl($url);

        $product = new Product([
            'domain' => $result['domain'],
            'code' => $result['code'],
        ]);

        if (!$product->save()) {
            throw new PSException('Error while saving product');
        }

        return $product;
    }

    /**
     * @param string $domain
     * @param int $code
     * @return Product|null
     */
    public function getProductByCode(string $domain, int $code)
    {
        return Product::findOne(['domain' => $domain, 'code' => $code]);
    }

    /**
     * @param string $url
     * @return Product|null
     * @throws PSException
     */
    public function getProductByUrl(string $url)
    {
        $result = $this->parseProductUrl($url);

        return $this->getProductByCode($result['domain'], $result['code']);
    }

    /**
     * @param string $url
     * @return array
     * @throws PSException
     */
    public function parseProductUrl(string $url)
    {
        preg_match(
            '/https:\/\/[www.]*wildberries.(?<domain>\w{2})\/catalog\/(?<code>\d+)\/detail.aspx/',
            $url,
            $matches
        );

        if (!isset($matches['domain']) || !isset($matches['code'])) {
            throw new PSException('Invalid url');
        }

        return [
            'domain' => $matches['domain'],
            'code' => $matches['code'],
        ];
    }
}
