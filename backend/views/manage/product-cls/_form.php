<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2017/10/30
 * Time: 16:55
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\widgets\iMessage\FormMsg;

?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode($this->title) ?></h3></div>

        <div class="panel-body">

            <?php $form = ActiveForm::begin(['method' => 'post', 'id' => $model->formName()]); ?>

            <?=
            $form->field($model, 'parent_id')->widget(Select2::classname(), [
                'data'          => $result['classify'],
                'options'       => ['placeholder' => '选择产品分类...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control', 'autofocus' => true]); ?>

            <?= $form->field($model, 'sort_id')->textInput(['maxlength' => true, 'id' => 'sort_id', 'class' => 'form-control']); ?>

            <?= $form->field($model, 'keywords')->textInput(['placeholder' => '分类关键字...', 'class' => 'form-control']); ?>

            <?=
            $form->field($model, 'description')->widget('kucha\ueditor\UEditor', [
                'clientOptions' => [
                    //编辑区域大小
                    'initialFrameHeight' => '400',
                    'elementPathEnabled' => false,
                    'wordCount'          => false,
                ],
            ]);
            ?>

            <?=
            $form->field($model, 'is_using')->widget(Select2::classname(), [
                'data'    => ['On' => '启用', 'Off' => '未启用'],
                'options' => ['placeholder' => '分类状态...'],
            ]);
            ?>

            <div class="form-group">

                <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>

                <a href='<?= Url::to(['index']) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

            </div>

            <?php ActiveForm::end(); ?>

            <?= FormMsg::widget(['config' => ['tpl' => 'AdminForm', 'FormName' => $model->formName(), 'Url' => Url::to(['product-cls/index']),]]); ?>

        </div>
    </div>
</div>