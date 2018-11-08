<?php

use yii\helpers\Url;
use yii\helpers\Html;
use phpnt\ICheck\ICheck;

/* @var $this yii\web\View */
/* @var $model common\models\RelevanceRoomsCoupon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default">

    <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

    <div class="panel-body">



    </div>

    <div class="panel-footer">

        <?= Html::submitButton( $model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg'] ) ?>

        <a href='<?= Url::to( ['index'] ) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

    </div>

</div>