<?php
/**
 * 
 * 产品 Handel
 * 
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/11/27
 * Time: 15:18
 */

namespace common\handel;

use linslin\yii2\curl\Curl;
use Yii;
use yii\base\Model;

class ShopHandel extends Model
{

    public static $AccessTokenUrl = 'http://api.weixin.qq.com/cgi-bin/poi/addpoi?access_token=';

    public static function ConnData($post, $token)
    {

        if (empty( $token )) {
            return [ 'status' => false, 'msg' => 'Token 不存在!' ];
        }

        if (empty( $post['business_name'] ) ||
            empty( $post['branch_name'] ) ||
            empty( $post['province'] ) ||
            empty( $post['city'] ) ||
            empty( $post['district'] ) ||
            empty( $post['address'] ) ||
            empty( $post['telephone'] ) ||
            empty( $post['categories'] ) ||
            empty( $post['longitude'] ) ||
            empty( $post['latitude'] )
        ) {
            return [ 'status' => false, 'msg' => '内容不齐全' ];
        }

        $data = [
            'business' => [
                'base_info' => [
                    'sid'           => $post['sid'],
                    'poi_id'        => $post['poi_id'],
                    'business_name' => $post['business_name'],
                    'branch_name'   => $post['branch_name'],
                    'province'      => $post['province'],
                    'city'          => $post['city'],
                    'district'      => $post['district'],
                    'address'       => $post['address'],
                    'telephone'     => $post['telephone'],
                    'categories'    => $post['categories'],
                    'offset_type'   => 3, // 坐标类型： 1 为火星坐标 2 为sogou经纬度 3 为百度经纬度 4 为mapbar经纬度 5 为GPS坐标 6 为sogou墨卡托坐标 注：高德经纬度无需转换可直接使用
                    'longitude'     => $post['longitude'], // 门店所在地理位置的经度
                    'latitude'      => $post['latitude'], // 门店所在地理位置的纬度
                    'avg_price'     => !empty( $post['avg_price'] ) ? $post['avg_price'] : 2,
                ],
            ],
        ];

        if (!empty( $post['photo_list'] )) {
            $data['business']['base_info']['photo_list'] = $post['photo_list'];
        }

        if (!empty( $post['recommend'] )) {
            $data['business']['base_info']['recommend'] = $post['recommend'];
        }

        if (!empty( $post['special'] )) {
            $data['business']['base_info']['special'] = $post['special'];
        }

        if (!empty( $post['introduction'] )) {
            $data['business']['base_info']['introduction'] = $post['introduction'];
        }

        if (!empty( $post['open_time'] )) {
            $data['business']['base_info']['open_time'] = $post['open_time'];
        }

        if (!empty( $post['update_status'] )) {
            $data['business']['base_info']['update_status'] = $post['update_status'];
        }

        exit(json_decode('{"province":"\u5e7f\u4e1c\u7701"}'));
        exit(json_encode( $data ));

        $curl = new Curl();
        $curl->setOption( CURLOPT_SSL_VERIFYPEER, false );
        $curl->setOption( CURLOPT_POSTFIELDS, json_encode( $data ) );

        $response = $curl->post( static::$AccessTokenUrl . $token );

        return json_decode( $response, true );
    }
}