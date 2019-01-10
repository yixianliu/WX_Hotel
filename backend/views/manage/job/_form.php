<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

?>

<?php $form = ActiveForm::begin(); ?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <div class='row' style="min-height: 900px;">

                <?= $form->field( $model, 'title' )->textInput( ['maxlength' => true] ) ?>

                <?=
                $form->field( $model, 'content' )->widget( 'kucha\ueditor\UEditor', [
                    'clientOptions' => [
                        //编辑区域大小
                        'lang'               => 'zh-cn',
                        'initialFrameHeight' => '500',
                        'elementPathEnabled' => false,
                        'wordCount'          => false,
                    ],
                ] );
                ?>

                <?= $form->field( $model, 'keywords' )->textInput( ['maxlength' => true] ) ?>

                <?= Yii::$app->view->renderFile( '@app/views/upload.php', ['model' => $model, 'id' => $model->job_id, 'text' => '上传图片', 'attribute' => 'images', 'form' => $form] ); ?>

                <div class="form-group">
                    <div class="alert alert-info" role="alert">
                        此类图片的最佳尺寸为 750 x 464 像素，用于显示类型为【每行一条数据】的板块产品的列表显示，推荐高度仅做参考，可以自我调整，显示时宽度按屏幕100%显示，高度自动变化，保持原图宽高比不变。
                    </div>
                </div>

                <?=
                $form->field( $model, 'is_using' )->widget( Select2::classname(), [
                    'data'          => ['On' => '启用', 'Off' => '禁用'],
                    'options'       => ['placeholder' => '是否启用...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ] );
                ?>

            </div>

        </div>

        <?= $form->field( $model, 'job_id' )->hiddenInput()->label( false ) ?>

        <?= $form->field( $model, 'is_language' )->hiddenInput()->label( false ) ?>

        <div class="panel-footer">

            <?= Html::submitButton( $model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg'] ) ?>

            <a href='<?= Url::to( ['index'] ) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

        </div>

    </div>
</div>

<?php ActiveForm::end(); ?>

