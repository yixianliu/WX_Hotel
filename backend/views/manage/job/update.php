<?php

$this->title = '更新招聘信息: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '招聘管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

