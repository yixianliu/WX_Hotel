<?php

$this->title = '更新小程序设置: ' . $model->wx_id;
$this->params['breadcrumbs'][] = ['label' => '小程序设置管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>

<?=
$this->render( '_form', [
    'model' => $model,
] )
?>

