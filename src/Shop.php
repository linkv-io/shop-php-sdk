<?php
namespace LinkV\Shop;

use LinkV\Shop\Util\Util;
use LinkV\Shop\Socket\SocketInterface;
use LinkV\Shop\Exception\ResponseException;
use LinkV\Shop\Model\BindResponse;
use LinkV\Shop\Model\GetVideoInfoResponse;
use LinkV\Shop\Model\GetFeedListResponse;
use LinkV\Shop\Model\GetNoticeListResponse;



/**
 * Class Shop
 *
 * @package LinkV\Shop
 */
class Shop
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
     * @var SocketInterface The httpclient.
     */
    protected $http;

    /**
     * @var string The uri.
     */
    protected $uri = 'https://ivs.linkv.sg';

    /**
     * Instantiates a new Shop super-class object.
     *
     * @param string $app_id
     * @param string $app_secret
     * @param SocketInterface $http
     *
     */
    public function __construct($app_id, $app_secret, $http)
    {
        $this->app_id = $app_id;
        $this->app_secret = $app_secret;
        $this->http = $http;
    }

    /**
     * Bind
     *
     * @param string $user_id
     * @param string $aid
     * @param string $name
     * @param string $portrait_uri
     * @param string $email
     * @param string $country_code
     * @param string $birthday
     * @param string $sex
     *
     * @return BindResponse
     *
     * @throws ResponseException
     *
     */
    public function Bind($user_id, $aid, $name = '', $portrait_uri = '', $email = '', $country_code = '', $birthday = '', $sex = '')
    {
        $nonce = Util::genNonce();

        $params = array();
        $params['app_id'] = $this->app_id;
        $params['nonce'] = $nonce;
        $params['user_id'] = $user_id;
        $params['aid'] = $aid;
        if (!empty($name)) {
            $params['name'] = $name;
        }
        if (!empty($name)) {
            $params['name'] = $name;
        }
        if (!empty($portrait_uri)) {
            $params['portrait_uri'] = $portrait_uri;
        }
        if (!empty($email)) {
            $params['email'] = $email;
        }
        if (!empty($country_code)) {
            $params['country_code'] = $country_code;
        }
        if (!empty($birthday)) {
            $params['birthday'] = $birthday;
        }
        if (!empty($sex)) {
            $params['sex'] = $sex;
        }

        $params['sign'] = Util::genSign($params, $this->app_secret);

        $header = array();
        $header['Content-Type'] = 'application/x-www-form-urlencoded';
        $header['User-Agent'] = 'PHP Composer SDK v0.0.1';

        $uri = $this->uri . '/open/v0/thGetToken';
        $resp = $this->http->post($uri, $header, $params);
        $status_code = isset($resp['status_code']) ? $resp['status_code'] : -1;
        $body = isset($resp['body']) ? $resp['body'] : '';

        if ($status_code != 200) {
            throw new ResponseException('http status code not 200');
        }
        $jsonData = json_decode($body, true);
        if ($jsonData == null) {
            throw new ResponseException("response decode error body:{$body}");
        }
        $status = isset($jsonData['status']) ? $jsonData['status'] : -1;
        $msg = isset($jsonData['msg']) ? $jsonData['msg'] : '';
        $data = isset($jsonData['data']) ? $jsonData['data'] : [];

        if ($status != 200) {
            throw new ResponseException("api result status not 200 message:{$msg}");
        }
        return new BindResponse($data);
    }

    /**
     * GetVideoInfoByVideoID
     *
     * @param string $video_id
     *
     * @return GetVideoInfoResponse
     *
     * @throws ResponseException
     *
     */
    public function GetVideoInfoByVideoID($video_id)
    {
        $nonce = Util::genNonce();

        $params = array();
        $params['app_id'] = $this->app_id;
        $params['nonce'] = $nonce;
        $params['video_id'] = $video_id;
        $params['sign'] = Util::genSign($params, $this->app_secret);

        $header = array();
        $header['Content-Type'] = 'application/x-www-form-urlencoded';
        $header['User-Agent'] = 'PHP Composer SDK v0.0.1';

        $uri = $this->uri . '/open/v0/getVideoInfo';
        $resp = $this->http->post($uri, $header, $params);
        $status_code = isset($resp['status_code']) ? $resp['status_code'] : -1;
        $body = isset($resp['body']) ? $resp['body'] : '';

        if ($status_code != 200) {
            throw new ResponseException('http status code not 200');
        }
        $jsonData = json_decode($body, true);
        if ($jsonData == null) {
            throw new ResponseException("response decode error body:{$body}");
        }
        $status = isset($jsonData['status']) ? $jsonData['status'] : -1;
        $msg = isset($jsonData['msg']) ? $jsonData['msg'] : '';
        $data = isset($jsonData['data']) ? $jsonData['data'] : [];

        if ($status != 200) {
            throw new ResponseException("api result status not 200 message:{$msg}");
        }
        return new GetVideoInfoResponse($data);
    }

    /**
     * GetFeedListByAttr
     *
     * @param string $attr
     * @param string $num
     * @param string $offset
     *
     * @return GetFeedListResponse
     *
     * @throws ResponseException
     *
     */
    public function GetFeedListByAttr($attr, $num, $offset)
    {
        $nonce = Util::genNonce();

        $params = array();
        $params['app_id'] = $this->app_id;
        $params['nonce'] = $nonce;
        $params['num'] = $num;
        $params['offset'] = $offset;
        $params['attr'] = $attr;

        $params['sign'] = Util::genSign($params, $this->app_secret);

        $header = array();
        $header['Content-Type'] = 'application/x-www-form-urlencoded';
        $header['User-Agent'] = 'PHP Composer SDK v0.0.1';

        $uri = $this->uri . '/open/v0/getFeedList';
        $resp = $this->http->post($uri, $header, $params);
        $status_code = isset($resp['status_code']) ? $resp['status_code'] : -1;
        $body = isset($resp['body']) ? $resp['body'] : '';

        if ($status_code != 200) {
            throw new ResponseException('http status code not 200');
        }
        $jsonData = json_decode($body, true);
        if ($jsonData == null) {
            throw new ResponseException("response decode error body:{$body}");
        }
        $status = isset($jsonData['status']) ? $jsonData['status'] : -1;
        $msg = isset($jsonData['msg']) ? $jsonData['msg'] : '';
        $data = isset($jsonData['data']) ? $jsonData['data'] : [];

        if ($status != 200) {
            throw new ResponseException("api result status not 200 message:{$msg}");
        }
        return new GetFeedListResponse($data);
    }
    /**
     * GetLiveNotice
     *
     *
     * @return GetLiveNotice
     *
     * @throws ResponseException
     *
     */
    public function GetLiveNotice()
    {
        $nonce = Util::genNonce();

        $params = array();
        $params['app_id'] = $this->app_id;
        $params['nonce'] = $nonce;
        $params['sign'] = Util::genSign($params, $this->app_secret);

        $header = array();
        $header['Content-Type'] = 'application/x-www-form-urlencoded';
        $header['User-Agent'] = 'PHP Composer SDK v0.0.1';

        $uri = $this->uri . '/live/notice';
        $resp = $this->http->post($uri, $header, $params);
        $status_code = isset($resp['status_code']) ? $resp['status_code'] : -1;
        $body = isset($resp['body']) ? $resp['body'] : '';

        if ($status_code != 200) {
            throw new ResponseException('http status code not 200');
        }
        $jsonData = json_decode($body, true);
        if ($jsonData == null) {
            throw new ResponseException("response decode error body:{$body}");
        }
        $status = isset($jsonData['status']) ? $jsonData['status'] : -1;
        $msg = isset($jsonData['msg']) ? $jsonData['msg'] : '';
        $data = isset($jsonData['data']) ? $jsonData['data'] : [];

        if ($status != 200) {
            throw new ResponseException("api result status not 200 message:{$msg}");
        }
        return new GetNoticeListResponse($data);
    }
}
