<?php

/* @var $this yii\web\View */
/* @var $model common\models\Rooms */

$this->title = '添加房间';
$this->params['breadcrumbs'][] = ['label' => '房间列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render( '_form', ['model' => $model, 'result' => $result] ) ?>