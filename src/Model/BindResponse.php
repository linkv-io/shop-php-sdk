<?php

namespace LinkV\Shop\Model;

use LinkV\Shop\Exception\ResponseException;

/**
 * Class BindResponse
 *
 * @package LinkV\Shop\Model
 */
class BindResponse
{
    /**
     * @var string The token.
     */
    protected $token;
    /**
     * @var string The shop_user_id.
     */
    protected $shop_user_id;

    /**
     * Instantiates a new Response super-class object.
     *
     * @param array $data
     *
     * @throws ResponseException
     */
    public function __construct($data)
    {
        $this->token = isset($data['token']) ? $data['token'] : '';
        $this->shop_user_id = isset($data['shop_user_id']) ? $data['shop_user_id'] : '';

        if ($this->token == '' || $this->shop_user_id  == '') {
            throw new ResponseException("token and shop_user_id error data:{".json_encode($data)."}");
        }
    }

    /**
     * return token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * return shop_user_id
     *
     * @return string
     */
    public function getShopUserID()
    {
        return $this->shop_user_id;
    }
}