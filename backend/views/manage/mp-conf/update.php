<?php

$this->title = '更新公众号配置: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '公众号配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

    <?= $this->render( '_form', [
        'model' => $model,
    ] ) ?>
