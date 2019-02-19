<?php
/**
 * 上传单个组件
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2019/1/25
 * Time: 15:05
 */

if (empty( $model ) || empty( $form ) || Yii::$app->user->isGuest) {
    exit( false );
}

$attribute = empty( $attribute ) ? 'thumb' : $attribute;

?>

<div class="form-group">
    <label>上传</label><br/>
    <?= $form->field( $model, $attribute )->fileInput( ['id' => 'UploadFileSimple'] )->label( false ) ?>
</div>

<script type="text/javascript" src="<?= Yii::getAlias( '@web' ) ?>/themes/js/plugins/fileinput/fileinput.min.js"></script>

<script type="text/javascript">

    $("#UploadFileSimple").fileinput({
        language: 'zh',
        showUpload: false,
        showCaption: false,
        showRemove : true,
        browseClass: "btn btn-danger",
        maxFileCount: 1,
        uploadUrl: '', //上传的地址
    });

</script>