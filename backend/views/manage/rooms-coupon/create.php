<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RelevanceRoomsCoupon */

$this->title = 'Create Relevance Rooms Coupon';
$this->params['breadcrumbs'][] = ['label' => 'Relevance Rooms Coupons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render( '_form', [
    'model'  => $model,
    'result' => $result,
] ) ?>

