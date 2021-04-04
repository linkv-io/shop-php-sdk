<?php

namespace LinkV\Shop\Model;

use LinkV\Shop\Exception\RequestException;

/**
 * Class VideoCloseRequest
 *
 * @package LinkV\Shop\Model
 */
class VideoCloseRequest
{
    /**
     * @var string The app_id.
     */
    protected $app_id;
    /**
     * @var string The video_id.
     */
    protected $video_id;

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
        $this->video_id = !empty($params['video_id']) ? $params['video_id'] : '';
        if ($this->app_id == '' || $this->video_id == '') {
            throw new RequestException("app_id and video_id error data:{" . json_encode($params) . "}");
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
     * return video_id
     *
     * @return string
     */
    public function getVideoID()
    {
        return $this->video_id;
    }
}