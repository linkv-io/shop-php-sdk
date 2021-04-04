<?php

namespace LinkV\Shop\Model;

use LinkV\Shop\Exception\RequestException;

/**
 * Class GetProductDescRequest
 *
 * @package LinkV\Shop\Model
 */
class GetProductDescRequest
{
    /**
     * @var string The app_id.
     */
    protected $app_id;
    /**
     * @var string The product_id.
     */
    protected $product_id;

    /**
     * Instantiates a new VideoOpenRequest super-class object.
     *
     * @param array $params
     *
     * @throws RequestException
     */
    public function __construct($params)
    {
        $this->app_id = !empty($params['app_id']) ? $params['app_id'] : '';
        $this->product_id = !empty($params['product_id']) ? $params['product_id'] : '';
        if ($this->app_id == '' || $this->product_id == '') {
            throw new RequestException("app_id and product_id error data:{" . json_encode($params) . "}");
        }
    }

    /**
     * return app_id
     *
     * @return string
     */
    public function getAppID()
    {
        return $this->app_id;
    }

    /**
     * return product_id
     *
     * @return string
     */
    public function getProductID()
    {
        return $this->product_id;
    }
}