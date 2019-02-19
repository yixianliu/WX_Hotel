<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use phpnt\ICheck\ICheck;

?>

<?php $form = ActiveForm::begin(); ?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <div class='row'>

                <?=
                $form->field( $model, 'hotel_id' )->widget( Select2::classname(), [
                    'data'          => $result['hotel'],
                    'options'       => ['placeholder' => '选择酒店...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ] );
                ?>

                <?=
                $form->field( $model, 'rooms_id' )->widget( Select2::classname(), [
                    'data'          => [],
                    'options'       => ['placeholder' => '选择酒店后,再选择房间...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ] );
                ?>

                <?= $form->field( $model, 'telphone' )->textInput( ['maxlength' => true] ) ?>

                <?= $form->field( $model, 'name' )->textInput( ['maxlength' => true] ) ?>

                <?=
                $form->field( $model, 'start_time' )->widget( 'kartik\daterange\DateRangePicker', [
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'timePicker'          => true,
                        'timePickerIncrement' => 30,
                        'format'              => 'Y年 - m月 - d日 h:i:A',
                    ],
                ] );
                ?>

                <?= $form->field( $model, 'advance_charge' )->widget( ICheck::className(), [
                    'type'    => ICheck::TYPE_RADIO_LIST,
                    'style'   => ICheck::STYLE_SQUARE,
                    'items'   => ['On' => '已支付', 'Off' => '未支付'],
                    'color'   => 'grey',
                    'options' => [
                        'item' => function ($index, $label, $name, $checked, $value) {
                            return '<input type="radio" id="advance_charge' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : false) . '> <label for="advance_charge' . $index . '">' . $label . '</label>&nbsp;&nbsp;';
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
                    ]] )
                ?>

            </div>

        </div>

        <div class="panel-footer">

            <?= Html::submitButton( $model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg'] ) ?>

            <a href='<?= Url::to( ['index'] ) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

        </div>
    </div>

    <?= Yii::$app->view->renderFile( '@app/views/_FormMsg.php' ); ?>

</div>

<?php ActiveForm::end(); ?>

<script type="text/javascript">

    $('#roomsappointment-hotel_id').change(function () {

        var RoomsId = $('#roomsappointment-rooms_id');

        RoomsId.empty();

        $.ajax({

            type: "GET",
            url: "<?= Url::to( ['rooms-appointment/index'] ) ?>?hotel_id=" + $(this).val(),
            dataType: "json",

            success: function (data) {

                if (data.status == true) {

                    $.each(data.msg, function (index, value) {
                        RoomsId.append("<option value='" + index + "'>" + value + "</option>");
                    });

                    return false;
                }

                alert(data['msg']);
                return false;
            },

            error: function (data) {

            }

        });

    });

</script>
