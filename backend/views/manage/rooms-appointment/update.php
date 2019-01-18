<?php

$this->title = '更新房间预约: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '房间预约管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';

?>

<?= $this->render( '_form', [
    'model'  => $model,
    'result' => $result,
] ) ?>
