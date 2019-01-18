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

            <?=
            $form->field( $model, 'parent_id' )->widget( Select2::classname(), [
                'data'          => $result['parent'],
                'options'       => ['placeholder' => '选择...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ] );
            ?>

            <?= $form->field( $model, 'name' )->textInput( ['maxlength' => true] ) ?>

            <?= $form->field( $model, 'sort_id' )->textInput( ['maxlength' => true] ) ?>

            <?=
            $form->field( $model, 'r_key' )->widget( Select2::classname(), [
                'data'          => $result['role'],
                'options'       => ['placeholder' => '选择角色...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ] );
            ?>

            <?=
            $form->field( $model, 'model_key' )->widget( Select2::classname(), [
                'data'          => $result['menu_model'],
                'options'       => ['placeholder' => '选择菜单模型...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ] );
            ?>

            <?= $form->field( $model, 'url_data' )->textInput( ['maxlength' => true] ) ?>

            <?=
            $form->field( $model, 'is_using' )->widget( Select2::classname(), [
                'data'          => ['On' => '启用', 'Off' => '未启用'],
                'options'       => ['placeholder' => '选择...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ] );
            ?>
        </div>

        <div class="panel-footer">

            <?= Html::submitButton( $model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg'] ) ?>

            <a href='<?= Url::to( ['index'] ) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

<script type="text/javascript">

    var ModelKey = $('#menu-model_key').val();

    $('.field-menu-url').hide();
    $('.field-menu-is_type').hide();

    // 超链接
    if (ModelKey == 'UU1') {
        $('.field-menu-url').show();
    }

    // 显示类型
    if (ModelKey != 'UU1' && ModelKey != '') {
        $('.field-menu-is_type').show();
    }

    $('#menu-model_key').on('change', function () {

        var selectVal = $(this).val();

        // 栏目类型
        if (selectVal != 'UU1' && (selectVal == 'UC1' || selectVal == 'UP2')) {

            $('.field-menu-is_type').show();

            // 链接
            $('.field-menu-url').hide();
            $('#menu-url').val('');
        }

        if (selectVal == 'UU1') {
            $('.field-menu-url').show();
            $('.field-menu-is_type').hide();
        }

        if ((selectVal != 'UC1' && selectVal != 'UP2') && selectVal != 'UU1') {

            $('.field-menu-url').hide();
            $('.field-menu-is_type').hide();

            // 单页面
            $('.field-menu-custom_key').hide();
            $('#menu-custom_key').attr("checked", "");

            // 链接
            $('#menu-url').val('');
        }

        return true;
    });

</script>
