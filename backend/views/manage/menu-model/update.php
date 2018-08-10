<?php

/* @var $this yii\web\View */
/* @var $model common\models\MenuModel */

$this->title = '更新菜单模型: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '菜单模型', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
