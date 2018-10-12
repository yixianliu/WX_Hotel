<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use phpnt\ICheck\ICheck;

/* @var $this yii\web\View */
/* @var $model common\models\RoomsTag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode($this->title) ?></h3></div>

        <div class="panel-body">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput([ 'maxlength' => true ]) ?>

            <?= $form->field($model, 'is_using')->widget(ICheck::className(), [
                'type'    => ICheck::TYPE_RADIO_LIST,
                'style'   => ICheck::STYLE_SQUARE,
                'items'   => [ 'On' => '开启', 'Off' => '关闭' ],
                'color'   => 'red',                  // цвет
                'options' => [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<input type="radio" id="is_classic' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : false) . '> <label for="is_classic' . $index . '">' . $label . '</label>&nbsp;&nbsp;';
                    },
                ] ])
            ?>

            <div class="alert alert-info push-down-20">
                <span style="color: #FFF500;">解释!</span><br/>
                房间参数就是每个房间的属性值,例如 : 含早餐 / 包含无线、宽带 / 含优惠卷 等等属性值,在发布房间信息的时候,就可以勾选对应的标签.
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>

            <div class="form-group">

                <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', [ 'class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg' ]) ?>

                <a href='<?= Url::to([ 'index' ]) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>