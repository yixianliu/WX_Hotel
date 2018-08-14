<?php


/* @var $this yii\web\View */
/* @var $model common\models\Hotels */

$this->title = '添加酒店房间';
$this->params['breadcrumbs'][] = ['label' => '酒店房间管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', ['model' => $model,]) ?>

