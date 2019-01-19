<?php

$this->title = '更新角色: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '角色管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';

?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>

