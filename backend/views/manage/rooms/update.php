<?php

/* @var $this yii\web\View */
/* @var $model common\models\Rooms */

$this->title = '更新房间内容: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '房间列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render('_form', ['model' => $model, 'result' => $result]) ?>