<?php

namespace LinkV\Shop\Model;

use LinkV\Shop\Exception\RequestException;

/**
 * Class DeductionRequest
 *
 * @package LinkV\Shop\Model
 */
class DeductionRequest
{
    /**
     * @var string The app_id.
     */
    protected $app_id;
    /**
     * @var string The request_id.
     */
    protected $request_id;
    /**
     * @var string The user_id.
     */
    protected $user_id;
    /**
     * @var string The gold.
     */
    protected $gold;
    /**
     * @var string The type.
     */
    protected $type;
    /**
     * @var string The reason.
     */
    protected $reason;
    /**
     * @var string The expr.
     */
    protected $expr;


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
        $this->request_id = !empty($params['request_id']) ? $params['request_id'] : '';
        $this->user_id = !empty($params['user_id']) ? $params['user_id'] : '';
        $this->gold = !empty($params['gold']) ? $params['gold'] : '';
        $this->type = !empty($params['type']) ? $params['type'] : '';
        $this->reason = !empty($params['expriation']) ? $params['expriation'] : '';
        $this->expr = !empty($params['expr']) ? $params['expr'] : '';

        if ($this->app_id == '' || $this->request_id == '' || $this->user_id == '' || $this->gold == '' || $this->type == '') {
            throw new RequestException("app_id, request_id, user_id, gold, type error data:{" . json_encode($params) . "}");
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
     * return request_id
     *
     * @return string
     */
    public function getRequestID()
    {
        return $this->request_id;
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
     * return gold
     *
     * @return int
     */
    public function getGold()
    {
        return (int)$this->gold;
    }

    /**
     * return type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * return reason
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * return expr
     *
     * @return string
     */
    public function getExpr()
    {
        return $this->expr;
    }

}