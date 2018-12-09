<?php
/**
 *
 * 上传组件
 *
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/7
 * Time: 23:24
 */

namespace common\components;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\base\Exception;
use yii\helpers\FileHelper;

/**
 * 文件上传处理
 */
class Upload extends Model
{

    /**
     *
     */
    public function upImage ()
    {
        $model = new static;
        $model->file = UploadedFile::getInstanceByName('file');
        if (!$model->file) {
            return false;
        }
        $relativePath = $successPath = '';
        if ($model->validate()) {
            $relativePath = Yii::$app->params['imageUploadRelativePath'];
            $successPath = Yii::$app->params['imageUploadSuccessPath'];
            $fileName = $model->file->baseName . '.' . $model->file->extension;
            if (!is_dir($relativePath)) {
                FileHelper::createDirectory($relativePath);
            }
            $model->file->saveAs($relativePath . $fileName);
            return [
                'code' => 0,
                'url' => Yii::$app->params['domain'] . $successPath . $fileName,
                'attachment' => $successPath . $fileName
            ];
        } else {
            $errors = $model->errors;
            return [
                'code' => 1,
                'msg' => current($errors)[0]
            ];
        }
    }
}