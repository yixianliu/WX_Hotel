<?php

$this->title = '添加小程序设置';
$this->params['breadcrumbs'][] = ['label' => '小程序设置管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>

