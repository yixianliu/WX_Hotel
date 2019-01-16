<?php

$this->title = '添加房间预约';
$this->params['breadcrumbs'][] = ['label' => '房间预约管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>
