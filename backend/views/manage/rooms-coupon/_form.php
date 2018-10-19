<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use phpnt\ICheck\ICheck;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\RelevanceRoomsCoupon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?php $form = ActiveForm::begin(); ?>

            <?=
            $form->field($model, 'coupon_key')->widget(Select2::classname(), [
                'data'          => $result['coupon'],
                'options'       => ['placeholder' => '选择...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

            <?=
            $form->field($model, 'room_id')->widget(Select2::classname(), [
                'data'          => $result['rooms'],
                'options'       => ['placeholder' => '选择...'],
                'pluginOptions' => [
                    'allowClear' => true
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