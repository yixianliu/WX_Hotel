<?php

$this->title = '更新语言类别: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '语言管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>

