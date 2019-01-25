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

if ( empty($model) || empty($form) || Yii::$app->user->isGuest ) {
    exit(false);
}


?>


<?= $form->field($model, 'imageFile')->fileInput() ?>

