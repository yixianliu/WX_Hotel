<?php

$this->title = '添加参数';
$this->params['breadcrumbs'][] = ['label' => '房间参数列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
