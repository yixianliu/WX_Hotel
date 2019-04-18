<?php
/**
 *
 * 上传组件
 *
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/30
 * Time: 21:39
 */

namespace common\handel;

use CURLFile;
use Exception;
use Yii;
use linslin\yii2\curl\Curl;
use yii\base\Model;

class WxMaterialHandel extends Model
{

    // 上传临时素材
    public static $UploadTempUrl = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token=';

    // 数量
    public static $CountUrl = 'https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token=';

    // 列表
    public static $ListTempUrl = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=';

    /**
     * 获取微信素材列表
     *
     * @param $token
     *
     * @return bool|string
     */
    public static function GetWxList($token)
    {

        if (empty( $token )) {
            return false;
        }

        $urls = static::$ListTempUrl . $token;

        $dataJson = '{"type":"image", "offset":"0", "count":"100"}';

        $resultJson = XmlHandle::postCurl( $urls, $dataJson );

        return $resultJson;
    }

    /**
     * 上传素材
     *
     * @param        $post
     * @param        $token
     * @param string $type
     *
     * @return array|mixed
     * @throws Exception
     */
    public static function ConnData($post, $token, $type = 'image')
    {

        if (empty( $post ) || empty( $token )) {
            return ['status' => false, 'msg' => '内容不可为空!'];
        }

        $WxMsg = [];

        foreach ($post as $value) {
            if (!file_exists( Yii::getAlias( '@webroot/' ) . $value )) {
                return ['status' => false, 'msg' => $value . ' - 文件地址不存在!'];
            }
        }

        foreach ($post as $value) {

            $file_data = Yii::getAlias( '@webroot/' ) . $value;

            $response = static::HttpUploadCurl( $file_data, $token, $type );

            if (!empty( $response['errcode'] )) {
                return $response;
            }

            $WxMsg[] = $response;

        }

        return $WxMsg;
    }

    /**
     * 获取素材数量
     *
     * @param $token
     *
     * @return mixed
     */
    public static function CountWxFile($token)
    {

        $curl = new Curl();

        $curl->setOption( CURLOPT_SSL_VERIFYPEER, false );
        $response = $curl->get( static::$CountUrl . $token );

        return json_decode( $response );
    }

    /**
     * PHP 非递归实现查询该目录下所有文件
     *
     * @param $dir
     *
     * @return array
     */
    public static function ScanFiles($dir)
    {

        if (!is_dir( $dir ))
            return [];

        // 兼容各操作系统
        $dir = rtrim( str_replace( '\\', '/', $dir ), '/' ) . '/';

        // 栈，默认值为传入的目录
        $dirs = [$dir];

        // 放置所有文件的容器
        $rt = [];

        do {
            // 弹栈
            $dir = array_pop( $dirs );

            // 扫描该目录
            $tmp = scandir( $dir );

            foreach ($tmp as $f) {
                // 过滤. ..
                if ($f == '.' || $f == '..')
                    continue;

                // 组合当前绝对路径
                $path = $dir . $f;


                // 如果是目录，压栈。
                if (is_dir( $path )) {
                    array_push( $dirs, $path . '/' );
                } else if (is_file( $path )) { // 如果是文件，放入容器中
                    $rt [] = $f;
                }
            }

        } while ($dirs); // 直到栈中没有目录

        return $rt;
    }

    /**
     * 微信公众号上传素材
     *
     * @param $file_data
     * @param $token
     * @param $type
     *
     * @return mixed
     * @throws Exception
     */
    public static function HttpUploadCurl($file_data, $token, $type)
    {

        $curl = new Curl();

        if (class_exists( '\CURLFile' )) {
            $curl->setOption( CURLOPT_SAFE_UPLOAD, true );
            $data = ['media' => new CURLFile( $file_data )];

        } else {

            if (defined( 'CURLOPT_SAFE_UPLOAD' )) {
                curl_setopt( $curl, CURLOPT_SAFE_UPLOAD, false );
            }

            $data = ['media' => '@' . realpath( $file_data )];
        }

        $curl->setOption( CURLOPT_SSL_VERIFYPEER, false );
        $curl->setOption( CURLOPT_POST, 1 );
        $curl->setOption( CURLOPT_RETURNTRANSFER, 1 );
        $curl->setOption( CURLOPT_SSL_VERIFYPEER, false );
        $curl->setOption( CURLOPT_POSTFIELDS, $data );

        $response = $curl->post( static::$TempUrl . $token . "&type=" . $type );

        $response = json_decode( $response, true );

        return $response;
    }
}