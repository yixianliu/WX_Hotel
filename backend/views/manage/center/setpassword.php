<?php
/**
 *
 * 改密码
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2017/12/1
 * Time: 9:48
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

?>

<div class="col-lg-12">
    <section class="box ">
        <header class="panel_header">
            <h2 class="title pull-left">
                <?= Html::encode($this->title) ?>
            </h2>
        </header>
        <div class="content-body">
            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'username')->hiddenInput(['readonly' => '']); ?>

                    <?= $form->field($model, 'password')->hiddenInput(['value' => '']); ?>

                    <?= $form->field($model, 'repassword')->hiddenInput(['value' => '']); ?>

                    <div class="form-group">
                        <?= Html::submitButton('修改密码', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                    <?= $this->render('../../formMsg'); ?>

                </div>
            </div>
        </div>
    </section>
</div>
