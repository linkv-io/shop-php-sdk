<?php

require_once 'vendor/autoload.php';

use LinkV\Shop\Shop;
use LinkV\Shop\Socket\SocketInterface;
use LinkV\Shop\Exception\ResponseException;

use LinkV\Shop\Notify;

class HttpClient implements SocketInterface
{
    public function get($url, $header, $params)
    {
        $url = $url . "?" . http_build_query($params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $body = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return ['status_code' => $status_code, 'body' => $body];
    }

    public function post($url, $header, $params)
    {
        $post_data = http_build_query($params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $body = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return ['status_code' => $status_code, 'body' => $body];
    }
}

function test_bind()
{
    $app_id = 'LM6000154116334399555433';
    $app_secret = '32023f26cf8e5da272143022b0b294d3';
    $http_client = new HttpClient();
    $a = new Shop($app_id, $app_secret, $http_client);

    try {
        $resp = $a->Bind('linkvuid1', 'linkvuid1');
        printf("token: %s\n", $resp->getToken());
        printf("shop_user_id: %s\n", $resp->getShopUserID());
    } catch (ResponseException $e) {
        echo $e;
    }
}

function test_video_info()
{
    $app_id = 'LM6000154116334399555433';
    $app_secret = '32023f26cf8e5da272143022b0b294d3';
    $http_client = new HttpClient();
    $a = new Shop($app_id, $app_secret, $http_client);

    try {
        $resp = $a->GetVideoInfoByVideoID('16175439883522215812');
        var_dump($resp);
    } catch (ResponseException $e) {
        echo $e;
    }
}

function test_notify_product()
{
    $app_id = 'LM6000154116334399555433';
    $app_secret = '32023f26cf8e5da272143022b0b294d3';
    $n = new Notify($app_id, $app_secret);

    var_dump($n->VerifyVideoOpenResponse([
        'status' => 200
    ]));
    var_dump($n->VerifyVideoCloseResponse([
        'status' => 200
    ]));
    var_dump($n->VerifyProductDescResponse([
        'status' => 200,
        'data' => [
            'product_id' => '测试优惠券',
            'title' => '测试专用',
            'img' => ['https://xxx.com.tw/product/100341?utm_source=supertaste_app&utm_medium=index'],
            'currency' => 'NT$',
            'curprice' => '2',
            'oldprice' => '6000',
            'url' => 'https://xxx.com.tw/product/100341?utm_source=supertaste_app&utm_medium=index',
            'species' => [
                [
                    'name' => 'aaa',
                    'tid' => 'ccc'
                ],
                [
                    'name' => 'bbb',
                    'tid' => 'ddd'
                ]
            ],
            'items' => [
                'ccc' => [
                    [
                        'type_name' => 'ccc1',
                        'type_gid' => 'ccc1'
                    ],
                    [
                        'type_name' => 'ccc2',
                        'type_gid' => 'ccc2'
                    ]
                ],
                'ddd' => [
                    [
                        'type_name' => 'ddd1',
                        'type_gid' => 'ddd1'
                    ],
                    [
                        'type_name' => 'ddd2',
                        'type_gid' => 'ddd2'
                    ]
                ]
            ]
        ]
    ]));
    var_dump($n->VerifyGetCouponResponse([
        'status' => 200,
        'data' => [
            'title' => '测试优惠券',
            'desc' => '测试专用',
            'img' => 'www.baidu.com'
        ]
    ]));
    var_dump($n->VerifyDeductionResponse([
        'status' => 200,
        'data' => [
            'gold' => '10'
        ]
    ]));
}

test_bind();
test_video_info();
test_notify_product();

