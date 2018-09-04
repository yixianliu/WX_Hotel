<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Rooms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode($this->title) ?></h3></div>

        <div class="panel-body">

            <?php $form = ActiveForm::begin(); ?>

            <?=
            $form->field($model, 'c_key')->widget(Select2::classname(), [
                'data'          => $result['classify'],
                'options'       => ['placeholder' => '分类'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>

            <?=
            $form->field($model, 'hotel_id')->widget(Select2::classname(), [
                'data'          => $result['hotel'],
                'options'       => ['placeholder' => '酒店'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>

            <?= $form->field($model, 'room_num')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

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

            <?= $form->field($model, 'num')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'check_in_num')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'introduction')->textarea(['maxlength' => true, 'rows' => 6]) ?>

            <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

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

            <?= $this->render('../../upload', ['model' => $model, 'id' => $model->room_id, 'attribute' => 'thumb', 'text' => '上传缩略图', 'form' => $form]); ?>

            <div class="form-group">
                <div class="alert alert-info" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <strong>提示!</strong> 此类图片的最佳尺寸为 400 x 400 像素，用于产品列表，购物车等地方展示
                </div>
            </div>

            <?= $this->render('../../upload', ['model' => $model, 'id' => $model->room_id, 'text' => '上传图片', 'form' => $form]); ?>

            <div class="form-group">
                <div class="alert alert-info" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <strong>提示!</strong> 此类图片的最佳尺寸为 750 x 464 像素，用于显示类型为【每行一条数据】的板块产品的列表显示，推荐高度仅做参考，可以自我调整，显示时宽度按屏幕100%显示，高度自动变化，保持原图宽高比不变.
                </div>
            </div>

            <br/> <br/> <br/> <br/>

            <?= $form->field($model, 'room_id')->hiddenInput()->label(false) ?>

            <div class="form-group">

                <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>

                <a href='<?= Url::to(['index']) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

