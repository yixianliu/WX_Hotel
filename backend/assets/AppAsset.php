<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'themes/css/theme-default.css',
    ];

    public $js = [
        'themes/js/plugins/jquery/jquery.min.js',
        'themes/js/plugins/jquery/jquery-ui.min.js',
        'themes/js/plugins/bootstrap/bootstrap.min.js',

        // 导航条
        'themes/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js',
        'themes/js/plugins.js',
        'themes/js/actions.js',
    ];

    // Js在顶部加载
    // $this->registerJsFile('xxx.js',['positon' => $this::POS_HEAD]); 加载单个Js文件
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD,
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
