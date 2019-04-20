<?php

$this->title = '添加酒店';
$this->params['breadcrumbs'][] = ['label' => '酒店房间管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render( '_form', ['model' => $model, 'result' => $result,] ) ?>

