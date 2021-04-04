<?php

namespace LinkV\Shop\Model;

use LinkV\Shop\Exception\RequestException;

/**
 * Class GetCouponRequest
 *
 * @package LinkV\Shop\Model
 */
class GetCouponRequest
{
    /**
     * @var string The app_id.
     */
    protected $app_id;
    /**
     * @var string The action_id.
     */
    protected $action_id;
    /**
     * @var string The user_id.
     */
    protected $user_id;
    /**
     * @var string The anchor_id.
     */
    protected $anchor_id;

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
        $this->action_id = !empty($params['action_id']) ? $params['action_id'] : '';
        $this->user_id = !empty($params['user_id']) ? $params['user_id'] : '';
        $this->anchor_id = !empty($params['anchor_id']) ? $params['anchor_id'] : '';
        if ($this->app_id == '' || $this->action_id == '' || $this->user_id == '' || $this->anchor_id == '') {
            throw new RequestException("app_id, action_id, user_id, anchor_id error data:{" . json_encode($params) . "}");
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
     * return action_id
     *
     * @return string
     */
    public function getActionID()
    {
        return $this->action_id;
    }

    /**
     * return user_id
     *
     * @return string
     */
    public function getUserID()
    {
        return $this->user_id;
    }

    /**
     * return anchor_id
     *
     * @return string
     */
    public function getAnchorID()
    {
        return $this->anchor_id;
    }
}