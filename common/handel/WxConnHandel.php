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
     * @param $app_id
     * @param $app_secret
     *
     * @return bool|mixed
     * @throws \Exception
     */
    public static function getAccessToken($app_id, $app_secret)
    {

        if (empty( $app_id ) || empty( $app_secret )) {
            return false;
        }

        $array = [
            'appid'      => $app_id,
            'secret'     => $app_secret,
            'grant_type' => 'client_credential',
        ];

        $bizString = SignHandel::ToUrlParams( $array );

        $authUrl = 'https://api.weixin.qq.com/cgi-bin/token?' . $bizString;

        $curl = new Curl();

        $curl->setOption( CURLOPT_SSL_VERIFYPEER, false );

        $response = $curl->get( $authUrl );

        return $response;
    }
}