<?php

$this->title = '更改简历: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '简历管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更改';
?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>
