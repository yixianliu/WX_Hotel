<?php

/**
 * @abstract 上传配置
 * @author Yxl <zccem@163.com>
 */
return [

    /*
     * 上传图片配置项
     */
    'serverUrl'           => '',
    'domain_url'          => '../../common/widgets/iUpload',
    // 执行上传图片的action名称
    "imageActionName"     => "uploadimage",
    // 提交的图片表单名称
    "imageFieldName"      => "file",
    // 上传大小限制，单位M
    "imageMaxSize"        => 8,
    // 上传图片格式显示
    "imageAllowFiles"     => [".png", ".jpg", ".jpeg", ".gif", ".bmp"],
    // 是否压缩图片,默认是true
    "imageCompressEnable" => true,
    // 图片压缩最长边限制
    "imageCompressBorder" => 1600,
    // 插入的图片浮动方式
    "imageInsertAlign"    => "none",
    // 图片访问路径前缀
    "imageUrlPrefix"      => "",
    // 上传保存路径,可以自定义保存路径和文件名格式
    "imagePathFormat"     => Yii::getAlias('@webroot') . "/../../product",
    // 关闭隐藏按钮
    "imageHiddenInput"    => false,

    /*
     * 上传文件配置
     */
    "fileActionName"      => "uploadfile", /* controller里,执行上传视频的action名称 */
    "fileFieldName"       => "upfile", /* 提交的文件表单名称 */
    // 上传保存路径,可以自定义保存路径和文件名格式
    "filePathFormat"      => "/ueditor/php/upload/file/{yyyy}{mm}{dd}/{time}{rand:6}",
    "fileUrlPrefix"       => "", /* 文件访问路径前缀 */
    "fileMaxSize"         => 51200000, /* 上传大小限制，单位B，默认50MB */
    // 上传文件格式显示
    "fileAllowFiles"      => [
        ".png", ".jpg", ".jpeg", ".gif", ".bmp",
        ".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg",
        ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid",
        ".rar", ".zip", ".tar", ".gz", ".7z", ".bz2", ".cab", ".iso",
        ".doc", ".docx", ".xls", ".xlsx", ".ppt", ".pptx", ".pdf", ".txt", ".md", ".xml"
    ],
];
