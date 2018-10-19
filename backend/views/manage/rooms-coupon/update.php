<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RelevanceRoomsCoupon */

$this->title = 'Update Relevance Rooms Coupon: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '房间关联优惠卷', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render( '_form', [
    'model'  => $model,
    'result' => $result,
] ) ?>
