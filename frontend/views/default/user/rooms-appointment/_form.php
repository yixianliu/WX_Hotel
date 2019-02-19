<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2019/2/19
 * Time: 16:05
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

<div class="form-group">
    <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
