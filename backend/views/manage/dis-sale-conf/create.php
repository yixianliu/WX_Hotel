<?php

$this->title = '添加分销设置';
$this->params['breadcrumbs'][] = ['label' => '分销设置中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>
