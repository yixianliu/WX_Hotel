<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MiniProgramConf */

$this->title = 'Update Mini Program Conf: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '小程序支付设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mini-program-conf-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
