<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Hotels */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode($this->title) ?></h3></div>

        <div class="panel-body">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'introduction')->textarea(['maxlength' => true, 'rows' => 6]) ?>

            <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

            <?=
            $form->field($model, 'content')->widget('kucha\ueditor\UEditor', [
                'clientOptions' => [
                    //编辑区域大小
                    'lang'               => 'zh-cn',
                    'initialFrameHeight' => '400',
                    'elementPathEnabled' => false,
                    'wordCount'          => false,
                ],
            ]);
            ?>

            <?=
            $form->field($model, 'is_promote')->widget(Select2::classname(), [
                'data'          => ['1' => '启用', '2' => '禁用'],
                'options'       => ['placeholder' => '推广状态...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>

            <?=
            $form->field($model, 'is_using')->widget(Select2::classname(), [
                'data'          => ['1' => '启用', '2' => '禁用'],
                'options'       => ['placeholder' => '审核状态...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>

			<?=
            $form->field($model, 'is_comments')->widget(Select2::classname(), [
                'data'          => ['1' => '启用', '2' => '禁用'],
                'options'       => ['placeholder' => '评论状态...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>

            <?= $this->render('../../upload', ['model' => $model, 'attribute' => 'thumb', 'text' => '上传缩略图', 'form' => $form]); ?>

            <?= $this->render('../../upload', ['model' => $model, 'text' => '上传图片', 'form' => $form]); ?>

            <div class="form-group">

                <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>

                <a href='<?= Url::to(['index']) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
