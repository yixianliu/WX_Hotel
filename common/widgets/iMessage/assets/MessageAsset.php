<?php
/**
 *
 * 样式
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2017/10/16
 * Time: 15:54
 */

namespace common\widgets\file_upload\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Xianan Huang <xianan_huang@163.com>
 */
class MessageAsset extends AssetBundle
{
    public $css = [

    ];

    public $js = [
        'jquery.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];

    /**
     * 初始化：sourcePath赋值
     * @see \yii\web\AssetBundle::init()
     */
    public function init()
    {
        $this->sourcePath = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'statics';
    }
}