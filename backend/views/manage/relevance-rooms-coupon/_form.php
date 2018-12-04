<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use phpnt\ICheck\ICheck;

/* @var $this yii\web\View */
/* @var $model common\models\RelevanceRoomsCoupon */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?=
            $form->field( $model, 'apply_range' )->widget( Select2::classname(), [
                'data'          => ['hotel' => '酒店适用', 'room' => '房间适用', 'classify' => '房间分类适用', 'all' => '通用'],
                'options'       => ['placeholder' => '派送类别'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ] );
            ?>

            <div class="alert alert-info" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <strong>请注意!</strong> This alert needs your attention, but it's not super important.
            </div>

            <div class="" id="Apply_Rang_Hotel">

                <?=
                $form->field( $model, 'hotel_id' )->widget( ICheck::className(), [
                    'type'    => ICheck::TYPE_CHECBOX_LIST,
                    'style'   => ICheck::STYLE_SQUARE,
                    'items'   => $result['hotel'],
                    'color'   => 'red',                  // цвет
                    'options' => [
                        'item' => function ($index, $label, $name, $checked, $value) {
                            return '<input type="checkbox" id="hotel_id' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : false) . '> <label for="hotel_id' . $index . '">' . $label . '</label>&nbsp;&nbsp;';
                        },
                    ] ] )
                ?>

            </div>

            <div class="" id="Apply_Rang_Room">

                <?=
                $form->field( $model, 'room_id' )->widget( ICheck::className(), [
                    'type'    => ICheck::TYPE_CHECBOX_LIST,
                    'style'   => ICheck::STYLE_SQUARE,
                    'items'   => $result['rooms'],
                    'color'   => 'red',                  // цвет
                    'options' => [
                        'item' => function ($index, $label, $name, $checked, $value) {
                            return '<input type="checkbox" id="room_id' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : false) . '> <label for="room_id' . $index . '">' . $label . '</label>&nbsp;&nbsp;';
                        },
                    ] ] )
                ?>

            </div>

            <?= $form->field($model, 'content')->textarea([ 'maxlength' => true ]) ?>

        </div>

        <div class="panel-footer">

            <?= Html::submitButton( $model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg'] ) ?>

            <a href='<?= Url::to( ['index'] ) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

        </div>

    </div>

<?php ActiveForm::end(); ?>

<script type="text/javascript">

</script>