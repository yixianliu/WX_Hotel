<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Conf */
/* @var $form yii\widgets\ActiveForm */

switch ($type) {

    case 'cn':
        $typeName = '中文';
        break;

    case 'en':
        $typeName = '英文';
        break;

    case 'system':
        $typeName = '系统配置';
        break;

    default:
        $typeName = '???';
        break;
}

?>

<div class="col-lg-12">
    <section class="box ">

        <header class="panel_header"><h2 class="title pull-left"><?= Html::encode($this->title) ?> - <?= $typeName ?></h2></header>

        <div class="content-body">
            <div class="row">

                <?php $form = ActiveForm::begin(); ?>

                <?php if ($type != 'system'): ?>

                    <?= $form->field($model, 'c_key')->textInput(['maxlength' => true]) ?>

                <?php else: ?>

                    <?= $form->field($model, 'c_key')->hiddenInput(['value' => 'Custom_' . time() . '_' . rand(100, 999)])->label(false); ?>

                <?php endif; ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?php if ($model->c_key != 'CODE_IMG'): ?>

                    <?= $form->field($model, 'parameter')->textarea(['rows' => 6]) ?>

                <?php else: ?>

                    <?= $this->render('../upload', ['model' => $model, 'form' => $form, 'attribute' => 'parameter', 'type' => 'conf', 'num' => 1]); ?>

                <?php endif; ?>

                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                <?=
                $form->field($model, 'is_using')->widget(Select2::classname(), [
                    'data'          => ['On' => '启用', 'Off' => '未启用'],
                    'options'       => ['placeholder' => '选择...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>

                <?php if (!empty($model->is_language) && empty($model->id)): ?>

                    <?=
                    $form->field($model, 'is_language')->widget(Select2::classname(), [
                        'data'          => ['cn' => '中文', 'en' => '英文'],
                        'options'       => ['placeholder' => '多语言...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>

                <?php endif; ?>

                <div class="form-group">

                    <?= Html::submitButton($model->isNewRecord ? '添加网站配置' : '更新网站配置', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                    <?= Html::a('返回列表', ['conf', 'type' => (empty($type) ? 'system' : $type)], ['class' => 'btn btn-primary']) ?>

                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

        <?= $this->render('../../formMsg'); ?>

    </section>
</div>


