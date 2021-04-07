<?php

namespace LinkV\Shop\Model;

use LinkV\Shop\Exception\ResponseException;

/**
 * Class GetNoticeListResponse
 *
 * @package LinkV\Shop\Model
 */
class GetNoticeListResponse
{
    /**
     * @var string The title.
     */
    protected $title;
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
        $this->list = isset($data['list']) ? $data['list'] : [];

        // if ($this->list == []) {
        //     throw new ResponseException("暂无直播预告");
        // }
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