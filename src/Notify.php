<?php

namespace LinkV\Shop;

use LinkV\Shop\Util\Util;
use LinkV\Shop\Exception\RequestException;
use LinkV\Shop\Model\VideoOpenRequest;
use LinkV\Shop\Model\VideoCloseRequest;
use LinkV\Shop\Model\GetProductDescRequest;
use LinkV\Shop\Model\GetCouponRequest;
use LinkV\Shop\Model\DeductionRequest;


/**
 * Class Notify
 *
 * @package LinkV\Shop
 */
class Notify
{
    /**
     * @var string The app_id.
     */
    protected $app_id;
    /**
     * @var string The app_secret.
     */
    protected $app_secret;

    /**
     * Instantiates a new Notify super-class object.
     *
     * @param string $app_id
     * @param string $app_secret
     *
     */
    public function __construct($app_id, $app_secret)
    {
        $this->app_id = $app_id;
        $this->app_secret = $app_secret;
    }

    /**
     * VerifyVideoOpenRequest
     *
     * @param array $post_form
     *
     * @return VideoOpenRequest|bool
     *
     * @throws RequestException
     *
     */
    public function VerifyVideoOpenRequest($post_form)
    {
        $params = array();
        $params['app_id'] = isset($post_form['app_id']) ? $post_form['app_id'] : '';
        $params['nonce'] = isset($post_form['nonce']) ? $post_form['nonce'] : '';
        $params['video_id'] = isset($post_form['video_id']) ? $post_form['video_id'] : '';
        $sign = isset($post_form['sign']) ? $post_form['sign'] : '';

        if ($sign != Util::genSign($params, $this->app_secret)) {
            return false;
        }
        return new VideoOpenRequest($params);
    }

    /**
     * VerifyVideoOpenResponse
     *
     * @param array $resp_arr
     *
     * @return bool
     *
     */
    public function VerifyVideoOpenResponse($resp_arr)
    {
        $status = isset($resp_arr['status']) ? $resp_arr['status'] : 0;

        if ($status != 200) {
            return false;
        }
        return true;
    }

    /**
     * VerifyVideoCloseRequest
     *
     * @param array $post_form
     *
     * @return VideoCloseRequest|bool
     *
     * @throws RequestException
     *
     */
    public function VerifyVideoCloseRequest($post_form)
    {
        $params = array();
        $params['app_id'] = isset($post_form['app_id']) ? $post_form['app_id'] : '';
        $params['nonce'] = isset($post_form['nonce']) ? $post_form['nonce'] : '';
        $params['video_id'] = isset($post_form['video_id']) ? $post_form['video_id'] : '';
        $sign = isset($post_form['sign']) ? $post_form['sign'] : '';

        if ($sign != Util::genSign($params, $this->app_secret)) {
            return false;
        }
        return new VideoCloseRequest($params);
    }

    /**
     * VerifyVideoCloseResponse
     *
     * @param array $resp_arr
     *
     * @return bool
     *
     */
    public function VerifyVideoCloseResponse($resp_arr)
    {
        $status = isset($resp_arr['status']) ? $resp_arr['status'] : 0;

        if ($status != 200) {
            return false;
        }
        return true;
    }

    /**
     * VerifyGetProductDescRequest
     *
     * @param array $post_form
     *
     * @return GetProductDescRequest|bool
     *
     * @throws RequestException
     *
     */
    public function VerifyGetProductDescRequest($post_form)
    {
        $params = array();
        $params['app_id'] = isset($post_form['app_id']) ? $post_form['app_id'] : '';
        $params['nonce'] = isset($post_form['nonce']) ? $post_form['nonce'] : '';
        $params['product_id'] = isset($post_form['product_id']) ? $post_form['product_id'] : '';
        $sign = isset($post_form['sign']) ? $post_form['sign'] : '';

        if ($sign != Util::genSign($params, $this->app_secret)) {
            return false;
        }
        return new GetProductDescRequest($params);
    }

    /**
     * VerifyProductDescResponse
     *
     * @param array $resp_arr
     *
     * @return bool
     *
     */
    public function VerifyProductDescResponse($resp_arr)
    {
        $status = isset($resp_arr['status']) ? $resp_arr['status'] : 0;
        $data = isset($resp_arr['data']) ? $resp_arr['data'] : null;
        if ($status != 200 || is_null($data)) {
            return false;
        }
        if (!isset($data['product_id']) || !isset($data['title']) || !isset($data['currency']) ||
            !isset($data['curprice']) || !isset($data['oldprice']) || !isset($data['url'])) {
            return false;
        }
        $img = isset($data['img']) ? $data['img'] : null;
        $species = isset($data['species']) ? $data['species'] : null;
        $items = isset($data['items']) ? $data['items'] : null;
        if (is_null($img) || is_null($species) || is_null($items)) {
            return false;
        }
        if (!is_array($img) || count($img) == 0) {
            return false;
        }
        if (!is_array($species) || count($species) == 0) {
            return false;
        }
        foreach ($species as $item) {
            $tid = isset($item['tid']) ? $item['tid'] : null;
            if (is_null($tid)) {
                return false;
            }
            $v = isset($items[$tid]) ? $items[$tid] : null;
            if (is_null($v)) {
                return false;
            }
            if (!is_array($v) || count($v) == 0) {
                return false;
            }
            foreach ($v as $vv) {
                $tName = isset($vv['type_name']) ? $vv['type_name'] : null;
                $tGID = isset($vv['type_gid']) ? $vv['type_gid'] : null;
                if (is_null($tName) || is_null($tGID)) {
                    return false;
                }
            }
        }
        return true;
    }


    /**
     * VerifyGetCouponRequest
     *
     * @param array $post_form
     *
     * @return GetCouponRequest|bool
     *
     * @throws RequestException
     *
     */
    public function VerifyGetCouponRequest($post_form)
    {
        $params = array();
        $params['app_id'] = isset($post_form['app_id']) ? $post_form['app_id'] : '';
        $params['nonce'] = isset($post_form['nonce']) ? $post_form['nonce'] : '';
        $params['action_id'] = isset($post_form['action_id']) ? $post_form['action_id'] : '';
        $params['user_id'] = isset($post_form['user_id']) ? $post_form['user_id'] : '';
        $params['anchor_id'] = isset($post_form['anchor_id']) ? $post_form['anchor_id'] : '';
        $sign = isset($post_form['sign']) ? $post_form['sign'] : '';

        if ($sign != Util::genSign($params, $this->app_secret)) {
            return false;
        }
        return new GetCouponRequest($params);
    }

    /**
     * VerifyGetCouponResponse
     *
     * @param array $resp_arr
     *
     * @return bool
     *
     */
    public function VerifyGetCouponResponse($resp_arr)
    {
        $status = isset($resp_arr['status']) ? $resp_arr['status'] : 0;
        $data = isset($resp_arr['data']) ? $resp_arr['data'] : null;
        if (($status != 201 && $status != 200) || is_null($data)) {
            return false;
        }
        if (!isset($data['title']) || !isset($data['desc']) || !isset($data['img'])) {
            return false;
        }
        return true;
    }


    /**
     * VerifyDeductionRequest
     *
     * @param array $post_form
     *
     * @return DeductionRequest|bool
     *
     * @throws RequestException
     *
     */
    public function VerifyDeductionRequest($post_form)
    {
        $params = array();
        $params['app_id'] = isset($post_form['app_id']) ? $post_form['app_id'] : '';
        $params['nonce'] = isset($post_form['nonce']) ? $post_form['nonce'] : '';
        $params['request_id'] = isset($post_form['request_id']) ? $post_form['request_id'] : '';
        $params['user_id'] = isset($post_form['user_id']) ? $post_form['user_id'] : '';

        $params['gold'] = isset($post_form['gold']) ? $post_form['gold'] : '';
        $params['expriation'] = isset($post_form['expriation']) ? $post_form['expriation'] : '';
        $params['type'] = isset($post_form['type']) ? $post_form['type'] : '';
        $params['reason'] = isset($post_form['reason']) ? $post_form['reason'] : '';

        $sign = isset($post_form['sign']) ? $post_form['sign'] : '';

        if ($sign != Util::genSign($params, $this->app_secret)) {
            return false;
        }
        return new DeductionRequest($params);
    }

    /**
     * VerifyDeductionResponse
     *
     * @param array $resp_arr
     *
     * @return bool
     *
     */
    public function VerifyDeductionResponse($resp_arr)
    {
        $status = isset($resp_arr['status']) ? $resp_arr['status'] : 0;
        $data = isset($resp_arr['data']) ? $resp_arr['data'] : null;
        if ($status != 200 || is_null($data)) {
            return false;
        }
        if (!isset($data['gold'])) {
            return false;
        }
        return true;
    }

}