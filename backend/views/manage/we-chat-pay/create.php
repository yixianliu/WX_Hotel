<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MiniProgramConf */

$this->title = 'Create Mini Program Conf';
$this->params['breadcrumbs'][] = ['label' => '小程序支付设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mini-program-conf-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
