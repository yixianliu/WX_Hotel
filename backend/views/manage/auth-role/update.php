<?php

$this->title = '更改认证角色: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '认证角色管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更改';
?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>
