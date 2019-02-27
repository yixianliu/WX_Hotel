<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use phpnt\ICheck\ICheck;

?>

<?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

        <div class="panel panel-default">

            <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

            <div class="panel-body">

                <?= $form->field( $model, 'name' )->textInput( ['maxlength' => true] ) ?>

                <?= $form->field( $model, 'description' )->textInput( ['maxlength' => true] ) ?>

                <?= $form->field( $model, 'rule_name' )->textInput( ['maxlength' => true] ) ?>

                <?= $form->field( $model, 'data' )->textInput( ['maxlength' => true] ) ?>

                <?=
                $form->field( $model, 'type' )->widget( ICheck::className(), [
                    'type'    => ICheck::TYPE_RADIO_LIST,
                    'style'   => ICheck::STYLE_SQUARE,
                    'items'   => ['1' => '认证用户', '2' => '认证权限'],
                    'color'   => 'grey',
                    'options' => [
                        'item' => function ($index, $label, $name, $checked, $value) {
                            return '<input type="radio" id="type' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : false) . '> <label for="type' . $index . '">' . $label . '</label>&nbsp;&nbsp;';
                        },
                    ]] )
                ?>

                <?=
                $form->field( $model, 'status' )->widget( ICheck::className(), [
                    'type'    => ICheck::TYPE_RADIO_LIST,
                    'style'   => ICheck::STYLE_SQUARE,
                    'items'   => ['1' => '已启用', '0' => '未启用'],
                    'color'   => 'grey',
                    'options' => [
                        'item' => function ($index, $label, $name, $checked, $value) {
                            return '<input type="radio" id="status' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : false) . '> <label for="status' . $index . '">' . $label . '</label>&nbsp;&nbsp;';
                        },
                    ]] )
                ?>

            </div>

            <div class="panel-footer">

                <?= Html::submitButton( $model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg'] ) ?>

                <a href='<?= Url::to( ['index'] ) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

            </div>

        </div>
    </div>

<?php ActiveForm::end(); ?>