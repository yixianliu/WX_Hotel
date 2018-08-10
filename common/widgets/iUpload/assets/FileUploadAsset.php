<?php

/**
 * @abstract Web Uploader 上传UI
 * @author Yxl <zccem@163.com>
 */

namespace common\widgets\iUpload\assets;

use Yii;
use yii\web\AssetBundle;

class FileUploadAsset extends AssetBundle
{

    public $css = [
        'webuploader.css',
    ];
    public $js = [
        'webuploader.js',
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
