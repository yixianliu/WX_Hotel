<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/7/21
 * Time: 10:41
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode($this->title) ?></h3></div>

        <div class="panel-body">

            <?php $form = ActiveForm::begin(); ?>

            <?=
            $form->field($model, 'c_key')->widget(Select2::classname(), [
                'data'          => $result['classify'],
                'options'       => ['placeholder' => '产品分类...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'autofocus' => true]); ?>

            <?= $form->field($model, 'price')->textInput(['maxlength' => true]); ?>

            <?= $form->field($model, 'discount')->textInput(['maxlength' => true]); ?>

            <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]); ?>

            <?= $form->field($model, 'introduction')->textarea(['style' => 'resize: none;', 'rows' => 8]); ?>

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
            $form->field($model, 'is_classic')->widget(Select2::classname(), [
                'data'          => ['On' => '开启', 'Off' => '关闭'],
                'options'       => ['placeholder' => '角色状态...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>

            <?=
            $form->field($model, 'is_winnow')->widget(Select2::classname(), [
                'data'          => ['On' => '开启', 'Off' => '关闭'],
                'options'       => ['placeholder' => '角色状态...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>

            <?=
            $form->field($model, 'is_recommend')->widget(Select2::classname(), [
                'data'          => ['On' => '开启', 'Off' => '关闭'],
                'options'       => ['placeholder' => '角色状态...'],
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
