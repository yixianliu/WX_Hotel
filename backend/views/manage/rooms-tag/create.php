<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RoomsTag */

$this->title = '添加房间标签';
$this->params['breadcrumbs'][] = ['label' => '房间标签管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

