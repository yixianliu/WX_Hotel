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

$text = empty( $text ) ? '上传缩略图' : $text;

$attribute = empty( $attribute ) ? 'thumb' : $attribute;

$ext = empty( $ext ) ? "['jpg', 'gif', 'png']" : $ext;

$divId = 'UploadFileSimple_' . rand( 1000, 9999 );

$id = empty( $id ) ? rand( 0000, 9999 ) : $id;

$this->registerJs( '

<script type="text/javascript" src="' . Yii::getAlias( '@web' ) . '/plugins/bootstrap-fileinput/js/fileinput.min.js"></script>
<script type="text/javascript" src="' . Yii::getAlias( '@web' ) . '/plugins/bootstrap-fileinput/js/locales/zh.js"></script>

', \yii\web\View::POS_END );

$this->registerCss( '

<link src="' . Yii::getAlias( '@web' ) . '/plugins/bootstrap-fileinput/css/fileinput.css">

', \yii\web\View::POS_HEAD );
?>

<div class="form-group">

    <label><?= $text ?></label><br/>

    <input type="file" id="<?= $divId ?>" name="UploadFileSimple"/>

    <div id="<?= $divId ?>_Msg"></div>

    <?= $form->field( $model, $attribute )->hiddenInput( ['id' => 'UploadFileSimple_Hidden'] )->label( false ) ?>

</div>

<script type="text/javascript">

    $("#<?= $divId ?>").fileinput({
        language: 'zh',
        showUpload: false,
        showCaption: false,
        showRemove: false,
        showCancel: false,
        browseClass: "btn btn-danger",
        maxFileCount: 1,
        uploadUrl: '<?= \yii\helpers\Url::to( ['upload/upload-single', 'id' => $id] ) ?>', //上传的地址
        allowedFileExtensions: <?= $ext ?>,

    }).on("fileuploaded", function (event, data) {

        $("#<?= $divId ?>_Msg").text(data.response.msg);

    });

</script>