<?php


$this->title = '添加公众号配置';
$this->params['breadcrumbs'][] = ['label' => '公众号配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>
