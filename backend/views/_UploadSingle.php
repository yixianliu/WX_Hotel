<?php
/**
 * 上传单个组件
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2019/1/25
 * Time: 15:05
 */

if (empty( $model ) || empty( $form )) {
    exit( false );
}

$type = empty($type) ? 'null' : $type;

$text = empty( $text ) ? '上传缩略图' : $text;

$attribute = empty( $attribute ) ? 'thumb' : $attribute;

$ext = empty( $ext ) ? "['jpg', 'gif', 'png']" : $ext;

$divId = 'UploadFileSimple_' . rand( 1000, 9999 );

$id = empty( $id ) ? rand( 0000, 9999 ) : $id;

$this->registerJsFile( '@web/plugins/bootstrap-fileinput/js/fileinput.min.js', ['depends' => ['backend\assets\AppAsset'], 'position' => $this::POS_END] );
$this->registerJsFile( '@web//plugins/bootstrap-fileinput/js/locales/zh.js', ['depends' => ['backend\assets\AppAsset'], 'position' => $this::POS_END] );
$this->registerCssFile( '@web/plugins/bootstrap-fileinput/css/fileinput.css', ['depends' => ['backend\assets\AppAsset'], 'position' => $this::POS_HEAD] );

?>

<div class="form-group">

    <label><?= $text ?></label><br/>

    <input type="file" id="<?= $divId ?>" class="file" name="UploadFileSimple"/>

    <?= $form->field( $model, $attribute )->hiddenInput( ['id' => 'UploadFileSimple_Hidden'] )->label( false ) ?>

</div>

<?php $this->beginBlock('UploadFileInput') ?>

    $('#<?= $divId ?>').fileinput({

        language: 'zh',
        showRemove: false,
        showCancel: false,
        browseClass: "btn btn-danger",
        maxFileCount: 1,
        uploadUrl: '<?= \yii\helpers\Url::to( ['upload/upload-single', 'id' => $id, 'type' => $type] ) ?>', //上传的地址
        allowedFileExtensions: <?= $ext ?>,

    }).on("fileuploaded", function (event, data) {

        console.log(data.response.msg);

        $('#UploadFileSimple_Hidden').val(data.response.path);

        return true;
    });

<?php $this->endBlock() ?>

<?php $this->registerJs($this->blocks['UploadFileInput'], \yii\web\View::POS_END); ?>
