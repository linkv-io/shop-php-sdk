<?php

namespace LinkV\Shop\Model;

use LinkV\Shop\Exception\ResponseException;

/**
 * Class GetFeedListResponse
 *
 * @package LinkV\Shop\Model
 */
class GetFeedListResponse
{
    /**
     * @var string The total_num.
     */
    protected $total_num;
    /**
     * @var string The cur_num.
     */
    protected $cur_num;

    /**
     * @var array The list.
     */
    protected $list;

    /**
     * Instantiates a new Response super-class object.
     *
     * @param array $data
     *
     * @throws ResponseException
     */
    public function __construct($data)
    {
        $this->total_num = isset($data['total_num']) ? $data['total_num'] : '';
        $this->cur_num = isset($data['cur_num']) ? $data['cur_num'] : '';
        $this->list = isset($data['list']) ? $data['list'] : '';

        if ($this->total_num == '' || $this->cur_num == '' || $this->list == '') {
            throw new ResponseException("total_num, cur_num, list error data:{" . json_encode($data) . "}");
        }
    }

    /**
     * return total_num
     *
     * @return string
     */
    public function getTotalNum()
    {
        return $this->total_num;
    }

    /**
     * return cur_num
     *
     * @return string
     */
    public function getCurNum()
    {
        return $this->cur_num;
    }

    /**
     * return list
     *
     * @return string
     */
    public function getList()
    {
        return $this->list;
    }
}