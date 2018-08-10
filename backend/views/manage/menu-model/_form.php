<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\MenuModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-lg-12">
    <section class="box ">

        <header class="panel_header">
            <h2 class="title pull-left"><?= Html::encode($this->title) ?></h2>
        </header>

        <div class="content-body">
            <div class="row">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'model_key')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'sort_id')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'url_key')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?=
                $form->field($model, 'is_using')->widget(Select2::classname(), [
                    'data'          => ['On' => '审核', 'Off' => '审核不过'],
                    'options'       => ['placeholder' => '是否启用...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>

                <div class="form-group">

                    <?= Html::submitButton($model->isNewRecord ? '创建菜单模型' : '更新菜单模型', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                    <?= Html::a('返回列表', ['index'], ['class' => 'btn btn-primary']) ?>

                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

        <?= $this->render('../../formMsg'); ?>

    </section>
</div>
