<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/6/22
 * Time: 15:21
 */

use yii\helpers\Url;
use yii\helpers\Html;
use dosamigos\fileupload\FileUpload;


$attribute = empty($attribute) ? 'path' : $attribute;

$id = empty($id) ? 1 : $id;

// 上传类型
$uploadType = empty(Yii::$app->controller->id) ? 'image' : Yii::$app->controller->id;

// 数量
$num = empty($num) ? 5 : $num;

// 初始化
$images = array();

// 取出图片
if (!empty($model->$attribute)) {

    $imagesArray = explode(',', $model->$attribute);

    foreach ($imagesArray as $value) {

        if (empty($value))
            break;

        $images[] = $value;
    }
}

$text = empty($text) ? '没有描述' : $text;

?>

<?=
FileUpload::widget([
    'model'         => $model,
    'attribute'     => 'image',
    'url'           => ['admin/upload/image-upload', 'id' => $id, 'type' => explode('/', Yii::$app->controller->id)[1], 'attribute' => $attribute],
    'options'       => ['accept' => 'file/*'],
    'clientOptions' => [
        'maxFileSize' => 2000000
    ],

    // Also, you can specify jQuery-File-Upload events
    // see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
    'clientEvents'  => [
        'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
        'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
    ],
]);
?>
