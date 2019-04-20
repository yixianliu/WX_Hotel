<?php

use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use phpnt\ICheck\ICheck;

?>

    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

        <div class="panel panel-default tabs">

            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#tab-1" role="tab" data-toggle="tab">基本资料</a></li>
                <li><a href="#tab-2" role="tab" data-toggle="tab">酒店参数</a></li>
            </ul>

            <?php $form = ActiveForm::begin(); ?>

            <div class="panel-body tab-content" style="min-height: 800px;">

                <div class="tab-pane active" id="tab-1">

                    <?= $form->field( $model, 'name' )->textInput( ['maxlength' => true] ) ?>

                    <?=
                    $form->field( $model, 'content' )->widget( 'kucha\ueditor\UEditor', [
                        'clientOptions' => [
                            //编辑区域大小
                            'lang'               => 'zh-cn',
                            'initialFrameHeight' => '400',
                            'elementPathEnabled' => false,
                            'wordCount'          => false,
                        ],
                    ] );
                    ?>

                    <?= Yii::$app->view->renderFile( '@app/views/_UploadSingle.php', [
                        'model'     => $model,
                        'id'        => $model->hotel_id,
                        'type'      => 'hotels',
                        'attribute' => 'thumb',
                        'text'      => '上传缩略图',
                        'form'      => $form] );
                    ?>

                    <div class="form-group">
                        <div class="alert alert-info" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            缩略图只允许上传一张，上传多张缩略图只会记录最后那张图片，此类图片的最佳尺寸为 400 x 400 像素，用于产品列表，购物车等地方展示。
                        </div>
                    </div>

                    <?= Yii::$app->view->renderFile( '@app/views/_Upload.php', [
                        'model'     => $model,
                        'id'        => $model->hotel_id,
                        'attribute' => 'images',
                        'text'      => '上传图片',
                        'form'      => $form] );
                    ?>

                    <div class="form-group">
                        <div class="alert alert-info" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            缩略图只允许上传一张，上传多张缩略图只会记录最后那张图片，此类图片的最佳尺寸为 400 x 400 像素，用于产品列表，购物车等地方展示。
                        </div>
                    </div>

                </div>

                <div class="tab-pane" id="tab-2">

                    <div class='row' style="min-height: 800px;">

                        <?=
                        $form->field( $model, 'lang_key' )->widget( Select2::classname(), [
                            'data'          => $result['lang'],
                            'options'       => [],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                        ] );
                        ?>

                        <?= $form->field( $model, 'password' )->textInput( ['maxlength' => true] ) ?>

                        <?= $form->field( $model, 'introduction' )->textarea( ['maxlength' => true, 'rows' => 6] ) ?>

                        <?= $form->field( $model, 'address' )->textarea( ['maxlength' => true, 'rows' => 3] ) ?>

                        <?= $form->field( $model, 'keywords' )->textInput( ['maxlength' => true, 'class' => 'tagsinput'] ) ?>

                        <?= $form->field( $model, 'is_promote' )->widget( ICheck::className(), [
                            'type'    => ICheck::TYPE_RADIO_LIST,
                            'style'   => ICheck::STYLE_SQUARE,
                            'items'   => ['On' => '启用', 'Off' => '禁用'],
                            'color'   => 'grey',
                            'options' => [
                                'item' => function ($index, $label, $name, $checked, $value) {
                                    return '<input type="radio" id="is_promote' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : false) . '> <label for="is_promote' . $index . '">' . $label . '</label>&nbsp;&nbsp;';
                                },
                            ]] )
                        ?>

                        <?= $form->field( $model, 'is_using' )->widget( ICheck::className(), [
                            'type'    => ICheck::TYPE_RADIO_LIST,
                            'style'   => ICheck::STYLE_SQUARE,
                            'items'   => ['On' => '启用', 'Off' => '禁用'],
                            'color'   => 'grey',
                            'options' => [
                                'item' => function ($index, $label, $name, $checked, $value) {
                                    return '<input type="radio" id="is_using' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : false) . '> <label for="is_using' . $index . '">' . $label . '</label>&nbsp;&nbsp;';
                                },
                            ]] );
                        ?>

                        <?= $form->field( $model, 'is_comments' )->widget( ICheck::className(), [
                            'type'    => ICheck::TYPE_RADIO_LIST,
                            'style'   => ICheck::STYLE_SQUARE,
                            'items'   => ['On' => '启用', 'Off' => '禁用'],
                            'color'   => 'grey',
                            'options' => [
                                'item' => function ($index, $label, $name, $checked, $value) {
                                    return '<input type="radio" id="is_comments' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : false) . '> <label for="is_comments' . $index . '">' . $label . '</label>&nbsp;&nbsp;';
                                },
                            ]] )
                        ?>

                    </div>

                </div>

            </div>

            <?= $form->field( $model, 'hotel_id' )->hiddenInput()->label( false ) ?>

            <div class="panel-footer">

                <?= Html::submitButton( $model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg'] ) ?>

                <a href='<?= Url::to( ['index'] ) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

<?php $this->registerJsFile( '../themes/js/plugins/tagsinput/jquery.tagsinput.min.js' ); ?>