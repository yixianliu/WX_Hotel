<?php
/**
 * 上传组件
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2019/1/25
 * Time: 15:05
 */

use yii\helpers\Url;
use yii\helpers\Html;

if (empty( $model ) || empty( $form ) || Yii::$app->user->isGuest) {
    exit( false );
}

$attribute = empty( $attribute ) ? 'thumb' : $attribute;

?>

<div class="form-group">
    <?= $form->field( $model, $attribute )->fileInput( ['id' => 'FileSimple'] ) ?>
</div>

<script type="text/javascript" src="<?= Yii::getAlias( '@web' ) ?>/themes/js/plugins/fileinput/fileinput.min.js"></script>

<script type="text/javascript">

    $(function () {

        $('#FileSimple').fileinput({
            language: 'zh', // 设置语言
            showUpload: false,
            showCaption: false,
            browseClass: "btn btn-danger",
            fileType: "image"
        });

    });

</script>