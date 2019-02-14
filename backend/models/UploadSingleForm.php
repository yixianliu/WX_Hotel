<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/10
 * Time: 20:26
 */

namespace backend\models;

use Yii;
use yii\base\Model;

class UploadSingleForm extends Model
{

    public $uploadName; //文件名
    public $uploadTmpName;//临时文件名
    public $uploadFinalName; //最终文件名
    public $uploadTargetDir = '../web/uploads';//最终文件夹
    public $uploadTargetFile;//最终路径
    public $uploadFileType;//文件类型
    public $allowUploadType = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif'];


    public static function UploadImg()
    {

    }

    public static function UploadCpm()
    {

    }

}