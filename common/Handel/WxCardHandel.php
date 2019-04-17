<?php
/**
 *
 * 微信公众号接口 - 卡卷
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/11/15
 * Time: 16:25
 */


namespace common\handel;

use linslin\yii2\curl\Curl;
use Yii;
use yii\base\Model;

class WxCardHandel extends Model
{

    public static $AccessTokenUrl = 'https://api.weixin.qq.com/card/create?access_token=';

    // 卡券类型
    public static $CARD_TYPE = [
        "GENERAL_COUPON",
        "GROUPON",
        "DISCOUNT", // 折扣券
        "GIFT",
        "CASH", // 代金券
        "MEMBER_CARD",
        "SCENIC_TICKET",
        "MOVIE_TICKET",
    ];

    public static $CODE_TYPE = [
        "CODE_TYPE_TEXT", // 文本
        "CODE_TYPE_BARCODE", // 一维码
        "CODE_TYPE_QRCODE", // 二维码
        "CODE_TYPE_ONLY_QRCODE", // 二维码无code显示
        "CODE_TYPE_ONLY_BARCODE", // 一维码无code显示；
        "CODE_TYPE_NONE", // 不显示code和条形码类型
    ];

    // 颜色
    public static $CARD_COLOR = [
        'Color010' => '#63b359',
        'Color020' => '#2c9f67',
        'Color030' => '#509fc9',
        'Color040' => '#5885cf',
        'Color050' => '#9062c0',
        'Color060' => '#d09a45',
        'Color070' => '#e4b138',
        'Color080' => '#ee903c',
        'Color081' => '#f08500',
        'Color082' => '#a9d92d',
        'Color090' => '#dd6549',
        'Color100' => '#cc463d',
        'Color101' => '#cf3e36',
        'Color102' => '#5E6671',
    ];


    public static function ConnData($post, $token)
    {

        if (empty( $post ) || !is_array( $post ) || empty( $token )) {
            return ['status' => false, 'msg' => '提交 Post 内容为空!'];
        }

        if (empty( $post['card_type'] )) {
            return ['status' => false, 'msg' => '卡券类型!'];
        }

        switch ($post['card_type']) {

            case 'GROUPON':
                $data = static::GrouponArray( $post );
                break;

            case 'CASH':
                $data = static::CashArray( $post );
                break;

            default:
                return ['status' => false, 'msg' => '不存在卡券类型!'];
                break;
        }

        $curl = new Curl();
        $curl->setOption( CURLOPT_SSL_VERIFYPEER, false );
        $curl->setOption( CURLOPT_SAFE_UPLOAD, false );
        $curl->setOption( CURLOPT_POSTFIELDS, json_encode( $data ) );

        $response = $curl->post( static::$AccessTokenUrl . $token );

        return json_decode( $response, true );
    }

    /**
     * 卡券基础信息
     *
     * @param $post
     *
     * @return array
     */
    public static function BaseArray($post)
    {
        if (empty( $post['title'] ) ||
            empty( $post['color'] ) ||
            empty( $post['type'] ) ||
            empty( $post['notice'] ) ||
            empty( $post['deal_detail'] ) ||
            empty( $post['description'] ) ||
            empty( $post['quantity'] ) ||
            empty( $post['code_type'] ) ||
            empty( $post['logo_url'] )
        ) {
            return ['status' => false, 'msg' => '内容不齐全!'];
        }

        if (!is_int( $post['quantity'] )) {
            return ['status' => false, 'msg' => '卡券库存的数量必须为数字!'];
        }

        // 数组
        $array = [

            'logo_url'    => $post['logo_url'],
            'code_type'   => $post['code_type'],
            'brand_name'  => $post['brand_name'],
            'title'       => $post['title'],
            'color'       => $post['color'],
            'notice'      => $post['notice'],
            'description' => $post['description'],

            // 商品信息
            'sku'         => [
                'quantity' => $post['quantity'],
            ],

            'date_info' => [
                'type'             => 'DATE_TYPE_FIX_TIME_RANGE', // DATE_TYPE_FIX_TIME_RANGE 表示固定日期区间，DATETYPE_FIX_TERM 表示固定时长 （自领取后按天算。
                'begin_timestamp'  => empty( $post['end_timestamp'] ) ? time() : $post['end_timestamp'],
                'end_timestamp'    => empty( $post['begin_timestamp'] ) ? time() + 860000 : $post['begin_timestamp'],
                'fixed_term'       => 15, // type为DATE_TYPE_FIX_TERM时专用，表示自领取后多少天内有效，不支持填写0。
                'fixed_begin_term' => 0, // type为DATE_TYPE_FIX_TERM时专用，表示自领取后多少天开始生效，领取后当天生效填写0。（单位为天）
            ],

            "use_limit"       => 100,
            "get_limit"       => 3,
            "use_custom_code" => false,
            "bind_openid"     => false,
            "can_share"       => true,
            "can_give_friend" => true,

            "center_title"         => empty( $post['center_title'] ) ? "立即使用" : $post['center_title'],
            "center_sub_title"     => empty( $post['center_sub_title'] ) ? $post['title'] : $post['center_sub_title'], // 按钮下方的文字
            "custom_url_name"      => empty( $post['custom_url_name'] ) ? "立即使用" : $post['custom_url_name'],
            "custom_url_sub_title" => empty( $post['custom_url_sub_title'] ) ? "自定义入口1" : $post['custom_url_sub_title'], // 6个汉字提示
            "promotion_url_name"   => empty( $post['promotion_url_name'] ) ? "更多优惠" : $post['promotion_url_name'],
        ];

        if (!empty( $post['promotion_url'] )) {
            $array['promotion_url'] = $post['promotion_url'];
        }

        if (!empty( $post['source'] )) {
            $array['source'] = $post['source'];
        }

        if (!empty( $post['center_url'] )) {
            $array['center_url'] = $post['center_url'];
        }

        return $array;
    }

    public static function AdvancedArray()
    {

        $array = [
            "use_condition"    => [
                "accept_category"             => "鞋类",
                "reject_category"             => "阿迪达斯",
                "can_use_with_other_discount" => true,
            ],
            "abstract"         => [
                "abstract"      => "微信餐厅推出多种新季菜品，期待您的光临",
                "icon_url_list" => [
                    "http://mmbiz.qpic.cn/mmbiz/p98FjXy8LacgHxp3sJ3vn97bGLz0ib0Sfz1bjiaoOYA027iasqSG0sjpiby4vce3AtaPu6cIhBHkt6IjlkY9YnDsfw/0",
                ],
            ],
            "text_image_list"  => [
                [
                    "image_url" => "http://mmbiz.qpic.cn/mmbiz/p98FjXy8LacgHxp3sJ3vn97bGLz0ib0Sfz1bjiaoOYA027iasqSG0sjpiby4vce3AtaPu6cIhBHkt6IjlkY9YnDsfw/0",
                    "text"      => "此菜品精选食材，以独特的烹饪方法，最大程度地刺激食 客的味蕾",
                ],
                [
                    "image_url" => "http://mmbiz.qpic.cn/mmbiz/p98FjXy8LacgHxp3sJ3vn97bGLz0ib0Sfz1bjiaoOYA027iasqSG0sj piby4vce3AtaPu6cIhBHkt6IjlkY9YnDsfw/0",
                    "text"      => "此菜品迎合大众口味，老少皆宜，营养均衡",
                ],
            ],
            "time_limit"       => [
                [
                    "type"         => "MONDAY",
                    "begin_hour"   => 0,
                    "end_hour"     => 10,
                    "begin_minute" => 10,
                    "end_minute"   => 59,
                ],
                [
                    "type" => "HOLIDAY",
                ],
            ],
            "business_service" => [
                "BIZ_SERVICE_FREE_WIFI",
                "BIZ_SERVICE_WITH_PET",
                "BIZ_SERVICE_FREE_PARK",
                "BIZ_SERVICE_DELIVER",
            ],
        ];

        return $array;
    }

    /**
     * 团购劵
     *
     * @param $post
     *
     * @return string
     */
    public static function GrouponArray($post)
    {

        if (empty( $post['deal_detail'] )) {
            return false;
        }

        $array = [
            'card' => [

                // 卡卷类型
                'card_type' => $post['card_type'],
                'groupon'   => [
                    "deal_detail" => $post['deal_detail'], // 团购券专用0，团购详情。
                ],
            ],
        ];

        $array['card']['groupon']['base_info'] = static::BaseArray( $post );

        if ($array['card']['groupon']['base_info']['status'] === false) {
            return $array['card']['groupon']['base_info'];
        }

        return json_encode( $array );
    }

    /**
     *  代金劵
     *
     * @param $post
     *
     * @return string
     */
    public static function CashArray($post)
    {
        if (empty( $post['least_cost'] ) || empty( $post['reduce_cost'] )) {
            return false;
        }

        $array = [
            'card' => [

                // 卡卷类型
                'card_type' => $post['card_type'],
                'cash'      => [
                    "least_cost"  => $post['least_cost'], // 代金券专用，表示起用金额（单位为分）,如果无起用门槛则填0。
                    "reduce_cost" => $post['reduce_cost'], // 代金券专用，表示减免金额。（单位为分）
                ],
            ],
        ];

        if (!($array['card']['cash']['base_info'] = static::BaseArray( $post ))) {
            return false;
        }

        return json_encode( $array );
    }


    public static function CardTypeArray()
    {
        return [
            "GENERAL_COUPON" => '优惠券',
            "GROUPON"        => '团购券',
            "DISCOUNT"       => '折扣券',
            "GIFT"           => '兑换券',
            "CASH"           => '代金券',
            "MEMBER_CARD",
            "SCENIC_TICKET",
            "MOVIE_TICKET",
        ];
    }
}