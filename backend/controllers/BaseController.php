<?php

/**
 * @abstract 基本控制器
 * @author   Yxl <zccem@163.com>
 */

namespace backend\controllers;

use common\models\Language;
use Yii;
use yii\web\Controller;

class BaseController extends Controller
{

    public $layout = 'admin';

    public static $assist = [];

    /**
     * 前置函数
     *
     * @param $action
     *
     * @return bool|\yii\web\Response
     */
    public function beforeAction($action)
    {

        // 跳转
        if (!file_exists( Yii::getAlias( '@common' ) . '/' . Yii::$app->params['WebInfo']['RD_FILE'] )) {
            return $this->redirect( [ '/mount/member/login' ] );
        }

        // Session
        if (Yii::$app->user->isGuest) {
            return $this->redirect( [ '/member/login' ] );
        }

        static::$assist = \common\models\Assist::findByData();

        $lang = Language::findOne(['is_default' => 'On']);

        Yii::$app->session->set('lang_key', $lang->lang_key);

        return true;
    }

    /**
     * @abstract 验证码
     */
    public function actions()
    {

        return [

            // 验证码
            'captcha' => [
                'class'     => 'yii\captcha\CaptchaAction',
                'height'    => 40,
                'width'     => 120,
                'minLength' => 4,
                'maxLength' => 5,
                'offset'    => 8,
            ],

            // 编辑器上传
            'upload'  => [
                'class'  => 'kucha\ueditor\UEditorAction',
                'config' => [
                    "imageUrlPrefix"  => "http://www.baidu.com",//图片访问路径前缀
                    "imagePathFormat" => "/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}", //上传保存路径
                    "imageRoot"       => Yii::getAlias( "@webroot" ),
                ],
            ],
        ];
    }

    /**
     * 随机生成关键KEY
     *
     * @param      $len
     * @param null $chars
     *
     * @return string
     */
    public static function getRandomString($len = 4, $chars = null)
    {

        if (is_null( $chars )) {
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        }

        mt_srand( 10000000 * (double)microtime() );

        for ($i = 0, $str = '', $lc = strlen( $chars ) - 1; $i < $len; $i++) {
            $str .= $chars[ mt_rand( 0, $lc ) ];
        }

        $str = $str . '_' . time() . '_' . rand( 0000, 9999 );

        return $str;
    }

}
