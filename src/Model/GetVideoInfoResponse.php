<?php

namespace LinkV\Shop\Model;

use LinkV\Shop\Exception\ResponseException;

/**
 * Class GetVideoInfoResponse
 *
 * @package LinkV\Shop\Model
 */
class GetVideoInfoResponse
{
    /**
     * @var string The title.
     */
    protected $title;
    /**
     * @var string The video_id.
     */
    protected $video_id;

    /**
     * @var string The user_id.
     */
    protected $user_id;
    /**
     * @var string The online.
     */
    protected $online;
    /**
     * @var string The room_state.
     */
    protected $room_state;
    /**
     * @var string The capture.
     */
    protected $capture;
    /**
     * @var string The watch_num.
     */
    protected $watch_num;
    /**
     * @var string The share_num.
     */
    protected $share_num;
    /**
     * @var string The like_num.
     */
    protected $like_num;
    /**
     * @var string The comment_num.
     */
    protected $comment_num;
    /**
     * @var string The hot_num.
     */
    protected $hot_num;


    /**
     * Instantiates a new Response super-class object.
     *
     * @param array $data
     *
     * @throws ResponseException
     */
    public function __construct($data)
    {
        $this->title = isset($data['title']) ? $data['title'] : '';
        $this->video_id = isset($data['video_id']) ? $data['video_id'] : '';
        $this->user_id = isset($data['user_id']) ? $data['user_id'] : '';
        $this->online = isset($data['online']) ? $data['online'] : '';
        $this->room_state = isset($data['room_state']) ? $data['room_state'] : '0';
        $this->capture = isset($data['capture']) ? $data['capture'] : '';
        $this->watch_num = isset($data['watch_num']) ? $data['watch_num'] : '0';
        $this->share_num = isset($data['share_num']) ? $data['share_num'] : '0';
        $this->like_num = isset($data['like_num']) ? $data['like_num'] : '0';
        $this->comment_num = isset($data['comment_num']) ? $data['comment_num'] : '0';
        $this->hot_num = isset($data['hot_num']) ? $data['hot_num'] : '0';

        if ($this->video_id == '' || $this->user_id == '' || $this->online == '' || $this->room_state == '') {
            throw new ResponseException("video_id,user_id,video_type,room_state error data:{" . json_encode($data) . "}");
        }
    }

    /**
     * return title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
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
     * return online
     *
     * @return string
     */
    public function getOnLine()
    {
        return $this->online;
    }

    /**
     * return room_state
     *
     * @return string
     */
    public function getRoomState()
    {
        return $this->room_state;
    }

    /**
     * return capture
     *
     * @return string
     */
    public function getCapture()
    {
        return $this->capture;
    }

    /**
     * return watch_num
     *
     * @return string
     */
    public function getWatchNum()
    {
        return $this->watch_num;
    }

    /**
     * return share_num
     *
     * @return string
     */
    public function getShareNum()
    {
        return $this->share_num;
    }

    /**
     * return like_num
     *
     * @return string
     */
    public function getLikeNum()
    {
        return $this->like_num;
    }

    /**
     * return comment_num
     *
     * @return string
     */
    public function getCommentNum()
    {
        return $this->comment_num;
    }

    /**
     * return hot_num
     *
     * @return string
     */
    public function getHotNum()
    {
        return $this->hot_num;
    }
}