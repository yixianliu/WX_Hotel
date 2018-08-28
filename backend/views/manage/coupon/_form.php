<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Coupon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode($this->title) ?></h3></div>

        <div class="panel-body">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'validity')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'denomination')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'quota')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>

            <?=
            $form->field($model, 'coupon_type')->widget(Select2::classname(), [
                'data'          => ['discount' => '折扣劵', 'coupon' => '优惠卷'],
                'options'       => ['placeholder' => '卡卷类型...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>

            <div class="form-group">

                <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>

                <a href='<?= Url::to(['index']) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
