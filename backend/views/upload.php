<?php
/**
 *
 * 上传整合组件
 * Js部分不可以加 return:false 这样会影响功能实现
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/3/28
 * Time: 17:06
 */

use yii\helpers\Url;
use yii\helpers\Html;
use dosamigos\fileupload\FileUploadUI;

if (empty($model) || empty($form))
    exit(false);

$attribute = empty($attribute) ? 'path' : $attribute;

$id = empty($id) ? null : $id;

// 用户 Id
$user_id = empty($user_id) ? Yii::$app->user->identity->user_id : $user_id;

// 上传文件后缀名
$uploadType = empty($uploadType) ? 'image' : $uploadType;

// 数量
$num = empty($num) ? 5 : $num;

// 初始化
$images = [];

// 取出图片,存储为数组
if (!empty($model->$attribute)) {

    $imagesArray = explode(',', $model->$attribute);

    foreach ($imagesArray as $value) {

        if (empty($value))
            break;

        $images[] = $value;
    }
}

$text = empty($text) ? '没有描述' : $text;

// 图片路径
$imgPathArray = explode('/', Yii::$app->controller->id);


switch ($imgPathArray[1]) {

    case 'download':
    case 'slide':
        $imgPath = Url::to('@web/../../frontend/web/temp/') . explode('/', Yii::$app->controller->id)[1];
        break;

    case 'sp-offer':
        $imgPath = Url::to('@web/../../frontend/web/temp/') . $user_id . '/sp_offer/';
        break;

    default:
    case 'product':
        $imgPath = Url::to('@web/../../frontend/web/temp/') . explode('/', Yii::$app->controller->id)[1] . '/' . $id;
        break;

}

?>

<style type="text/css">
    .preview img {
        width: 180px;
        height: 100px;
    }
</style>

<hr/>

<div class="form-group">

    <label><?= $text ?></label>

    <?=
    FileUploadUI::widget([
        'model'         => $model,
        'attribute'     => $attribute,
        'url'           => ['admin/upload/image-upload', 'id' => $id, 'type' => explode('/', Yii::$app->controller->id)[1], 'attribute' => $attribute, 'ext' => $uploadType],
        'gallery'       => false,
        'fieldOptions'  => [
            'accept' => $uploadType . '/*',
        ],
        'clientOptions' => [
            'maxFileSize'      => 2000000,
            'dataType'         => 'json',
            'maxNumberOfFiles' => $num,
        ],

        // ...
        'clientEvents'  => [

            'fileuploaddone' => 'function(e, data) {
            
                                console.log(e);
                                console.log(data);
                                
                                var ImagesContent = $("#ImagesContent_' . $attribute . '");
                                
                                var num = ' . $num . ';
                                
                                var html = "";
                                 
                                if (num > 1) {
                                
                                    $.each(data.result.files, function (index, file) {
                                        html += file.name + \',\';
                                    });
                                    
                                    html += ImagesContent.val();
                                    
                                } else {
                                    html = data.result.files[0].name;
                                }
                                
                                ImagesContent.attr("value", html);
                                
                                if (data.result.error != "" && data.result.files == "") {
                                    $("#UploadMessage").show().append(data.result.message);
                                }
                                
                            }',

            'fileuploadfail' => 'function(e, data) {
            
                                console.log(e);
                                console.log(data);
                      
                            }',
        ],
    ]);
    ?>

    <?= $form->field($model, $attribute)->textInput(['id' => 'ImagesContent_' . $attribute, 'style' => 'display:none;'])->label(false) ?>

</div>

<div class="row">

    <div class="col-md-12">
        <h5>
            <div id='UploadMessage' style='display: none;'><span class="label label-danger">错误</span>&nbsp;&nbsp;</div>
        </h5>
    </div>

</div>

<hr/>

<div class="form-group">

    <?php if (!empty($images) && is_array($images)): ?>

        <div class="row">

            <?php foreach ($images as $value): ?>

                <div class="col-md-3">

                    <?= Html::img($imgPath . '/' . $value, ['width' => 350, 'height' => 150]); ?>

                    <div class="portfolio-info" style="margin-top: 10px;margin-bottom: 10px;">

                        <?php if (Yii::$app->controller->id != 'sp-offer'): ?>
                            <a class="btn btn-danger DeleteImg" data-type="GET" title="删除这个文件 : <?= $value ?>">
                                <input class="DeleteImgHidden" type="hidden" value="<?= $value ?>"/><i class="glyphicon glyphicon-trash"></i> <font>删除</font>
                            </a>
                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach ?>

        </div>

        <script type="text/javascript">

            $('.DeleteImg').on('click', function () {

                var DeleteImgText = $(this).find('.DeleteImgHidden').val();

                // 获取 ID
                var ImageId = $('#ImagesContent_<?= $attribute ?>');

                var imgArray = ImageId.val().split(',');

                // 重新处理
                var NewImageContent = '';

                for (var i = 0; i < imgArray.length; i++) {

                    if (imgArray[i] == DeleteImgText || imgArray[i] == '') {
                        continue;
                    }

                    NewImageContent += imgArray[i] + ',';
                }

                ImageId.empty().attr('value', NewImageContent);

                $(this).parent('div').parent('div').hide();

                return true;
            });

        </script>

    <?php else: ?>

        <div class="row">
            <div class="col-md-12">
                <h3>暂无任何上传的内容 !!</h3>
            </div>
        </div>

    <?php endif ?>

    <hr/>

</div>
