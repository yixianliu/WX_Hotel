<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Menu */

$this->title = '创建菜单';
$this->params['breadcrumbs'][] = ['label' => '菜单中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?=
$this->render('_form', [
    'model'  => $model,
    'result' => $result,
]);
?>

