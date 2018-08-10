<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */

$this->title = '更新菜单: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '菜单中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>

<?=
$this->render('_form', [
    'model'  => $model,
    'result' => $result,
]);
?>
