<?php
/**
 *
 * 微信公众号接口
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/11/14
 * Time: 11:02
 */
namespace common\handel;

use Yii;
use linslin\yii2\curl\Curl;
use yii\base\Model;

class WxConnHandel extends Model
{

    /**
     * 获取 Token
     *
     * @param $appid
     * @param $app_secret
     *
     * @return string
     */
    public static function getAccessToken($appid, $app_secret)
    {

        if (empty( $appid ) || empty( $app_secret )) {
            return false;
        }

        $array = [
            'appid'      => $appid,
            'secret'     => $app_secret,
            'grant_type' => 'client_credential',
        ];

        $bizString = SignHandel::ToUrlParams( $array );

        $authUrl = 'https://api.weixin.qq.com/cgi-bin/token?' . $bizString;

        $curl = new Curl();

        $curl->setOption(CURLOPT_SSL_VERIFYPEER, false);

        $response = $curl->get($authUrl);

        return $response;
    }
}