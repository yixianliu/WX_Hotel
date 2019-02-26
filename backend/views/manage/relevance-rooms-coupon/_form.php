<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

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
            <strong>请注意!</strong> 派送类别
        </div>

        <div class="form-group">

            <?=
            $form->field( $model, 'hotel_id' )->widget( Select2::classname(), [
                'data'          => $result['hotel'],
                'options'       => ['placeholder' => '选择房间'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ] );
            ?>

        </div>

        <div class="form-group" id="RoomsId" style="display: none;"></div>

        <?= $form->field( $model, 'content' )->textarea( ['maxlength' => true, 'rows' => 8] ) ?>

    </div>

    <?= $form->field( $model, 'user_id' )->hiddenInput()->label( false ) ?>

    <div class="panel-footer">

        <?= Html::submitButton( $model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg'] ) ?>

        <a href='<?= Url::to( ['index'] ) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

    </div>

</div>

<?php ActiveForm::end(); ?>

<script type="text/javascript">

    $('#relevanceroomscoupon-hotel_id').change(function () {

        $('#RoomsId').show();

        var selectId = $(this).val();

        $.ajax({

            type: "GET",
            url: '<?= Url::to( ['rooms/ajax-res'] ) ?>?id=' + selectId,
            dataType: "json",
            success: function (data) {

                $('#RoomsId').empty();

                $('#RoomsId').append('<label class="control-label" for="">旗下酒店</label><br/>');

                if (data.result.length == 0) {
                    $('#RoomsId').append('<h3>没有找到相关的房间!</h3>');
                    return false;
                }

                for (var i = 0; i < data.result.length; i++) { // 几个人有几个checkbox
                    $('#RoomsId').append("<input type='checkbox' class='icheckbox_minimal-grey' value='" + data.result[i].rooms_id + "' id='" + data.result[i].rooms_id + "' name='RelevanceRoomsCoupon[room_id][]'/>");
                    $('#RoomsId').append("&nbsp;&nbsp;<label for=" + data.result[i].rooms_id + ">" + data.result[i].title + "</label>");
                }

                return true;
            },

            error: function (jqXHR) {
                console.log("Error: " + jqXHR.status);
            }
        });

    });

</script>
