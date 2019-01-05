<?php

$this->title = '更改分销设置: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '分销设置中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>
