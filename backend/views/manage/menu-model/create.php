<?php

/* @var $this yii\web\View */
/* @var $model common\models\MenuModel */

$this->title = '添加菜单模型';
$this->params['breadcrumbs'][] = ['label' => '菜单模型', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
