<?php

namespace LinkV\Shop\Socket;

/**
 * SocketInterface
 *
 * @package LinkV\Shop\Socket
 */
interface SocketInterface
{
    /**
     * get 发送请求
     *
     * @param string $url
     * @param array $header
     * @param array $params
     *
     * @return array ['status_code':xxx,'body':'']
     */
    public function get($url,$header,$params);

    /**
     * get 发送请求
     *
     * @param string $url
     * @param array $header
     * @param array $params
     *
     * @return array ['status_code':xxx,'body':'']
     */
    public function post($url,$header,$params);
}