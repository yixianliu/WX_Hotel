<?php
/**
 *
 * photoClip
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2017/10/12
 * Time: 14:57
 */

namespace common\widgets\iUpload\assets;

use Yii;
use yii\web\AssetBundle;

class FileUploadHeadAsset extends AssetBundle
{

    public $css = [

    ];

    // js
    public $js = [
        'photoClip/iscroll-zoom.js',
        'photoClip/hammer.js',
        'photoClip/lrz.all.bundle.js',
        'photoClip/jquery.photoClip.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];

    /**
     * 初始化：sourcePath赋值
     *
     * @see \yii\web\AssetBundle::init()
     */
    public function init()
    {
        $this->sourcePath = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'statics';
    }

}