<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = '添加订单';
$this->params['breadcrumbs'][] = ['label' => '订单中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>
