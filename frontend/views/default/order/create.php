<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = '确认订单';
$this->params['breadcrumbs'][] = ['label' => '订单管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'      => $model,
        'hotelModel' => $hotelModel,
        'roomModel'  => $roomModel,
    ]) ?>

</div>
