<?php

$this->title = '添加招聘信息';
$this->params['breadcrumbs'][] = ['label' => '招聘管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
