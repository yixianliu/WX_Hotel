<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use phpnt\ICheck\ICheck;

/* @var $this yii\web\View */
/* @var $model common\models\Rooms */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="row">
        <div class="col-md-12">

            <?php $form = ActiveForm::begin( ['class' => 'form-horizontal'] ); ?>

            <div class="panel panel-default tabs">

                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#tab-1" role="tab" data-toggle="tab">基本资料</a></li>
                    <li><a href="#tab-2" role="tab" data-toggle="tab">房间参数</a></li>
                    <li><a href="#tab-3" role="tab" data-toggle="tab">房间标签</a></li>
                    <li><a href="#tab-4" role="tab" data-toggle="tab">房间状态</a></li>
                </ul>

                <div class="panel-body tab-content">

                    <div class="tab-pane active" id="tab-1">

                        <div class='row' style="min-height: 1200px;">
                            <?=
                            $form->field( $model, 'hotel_id' )->widget( Select2::classname(), [
                                'data'          => $result['hotel'],
                                'options'       => ['placeholder' => '酒店'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ] );
                            ?>

                            <?=
                            $form->field( $model, 'c_key' )->widget( Select2::classname(), [
                                'data'          => $result['classify'],
                                'options'       => ['placeholder' => '分类'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ] );
                            ?>

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

                            <?= $form->field( $model, 'num' )->textInput( ['maxlength' => true] ) ?>

                            <?= $form->field( $model, 'price' )->textInput( ['maxlength' => true] ) ?>

                            <?= Yii::$app->view->renderFile( '@app/views/upload.php', ['model' => $model, 'id' => $model->rooms_id, 'num' => 1, 'attribute' => 'thumb', 'text' => '上传缩略图', 'form' => $form] ); ?>

                            <div class="form-group">
                                <div class="alert alert-info" role="alert">
                                    缩略图只允许上传一张，上传多张缩略图只会记录最后那张图片，此类图片的最佳尺寸为 400 x 400 像素，用于产品列表，购物车等地方展示。
                                </div>
                            </div>

                            <?= Yii::$app->view->renderFile( '@app/views/upload.php', ['model' => $model, 'id' => $model->rooms_id, 'text' => '上传图片', 'attribute' => 'images', 'form' => $form] ); ?>

                            <div class="form-group">
                                <div class="alert alert-info" role="alert">
                                    此类图片的最佳尺寸为 750 x 464 像素，用于显示类型为【每行一条数据】的板块产品的列表显示，推荐高度仅做参考，可以自我调整，显示时宽度按屏幕100%显示，高度自动变化，保持原图宽高比不变。
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane" id="tab-2">
                        <div class='row' style="min-height: 800px;">

                            <?php if (!empty( $result['field'] )): ?>

                                <?php foreach ($result['field'] as $value): ?>

                                    <div class="col-md-3">
                                        <label class="control-label" for="rooms-<?= $value['f_key']; ?>"><?= $value['name'] ?></label>
                                        <input type="text" id="rooms-<?= $value['f_key']; ?>" class="form-control" name="Rooms[f_key][<?= $value['f_key'] ?>]" aria-required="true">
                                    </div>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </div>
                    </div>

                    <div class="tab-pane" id="tab-3">
                        <div class='row' style="min-height: 800px;">

                            <?php if (!empty( $result['tag'] )): ?>

                                <?php foreach ($result['tag'] as $value): ?>
                                    <div class="col-md-2">

                                        <label class="check">
                                            <input type="checkbox" class="icheckbox" name="Rooms[t_key][]" value="<?= $value['t_key'] ?>"/> <?= $value['name'] ?>
                                        </label>

                                    </div>
                                <?php endforeach; ?>

                            <?php endif; ?>

                        </div>
                    </div>

                    <div class="tab-pane" id="tab-4">
                        <div class='row' style="min-height: 800px;">

                            <?= $form->field( $model, 'room_num' )->textInput( ['maxlength' => true] ) ?>

                            <?= $form->field( $model, 'discount' )->textInput( ['maxlength' => true] ) ?>

                            <?= $form->field( $model, 'introduction' )->textarea( ['maxlength' => true, 'rows' => 6] ) ?>

                            <?= $form->field( $model, 'keywords' )->textInput( ['maxlength' => true, 'class' => 'tagsinput'] ) ?>

                            <div class="form-group">
                                <div class="alert alert-info" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    关键词用逗号分开 ","
                                </div>
                            </div>

                            <?= $form->field( $model, 'is_using' )->widget( ICheck::className(), [
                                'type'    => ICheck::TYPE_RADIO_LIST,
                                'style'   => ICheck::STYLE_SQUARE,
                                'items'   => ['On' => '启用', 'Off' => '禁用'],
                                'color'   => 'grey',
                                'options' => [
                                    'item' => function ($index, $label, $name, $checked, $value) {
                                        return '<input type="radio" id="is_using' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : false) . '> <label for="is_using' . $index . '">' . $label . '</label>&nbsp;&nbsp;';
                                    },
                                ]] )
                            ?>

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

                            <?=
                            $form->field( $model, 'is_comments' )->widget( ICheck::className(), [
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

                <?= $form->field( $model, 'rooms_id' )->hiddenInput()->label( false ) ?>

                <div class="panel-footer">

                    <?= Html::submitButton( $model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg'] ) ?>

                    <a href='<?= Url::to( ['index'] ) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

<?php $this->registerJsFile( '../themes/js/plugins/tagsinput/jquery.tagsinput.min.js' ); ?>