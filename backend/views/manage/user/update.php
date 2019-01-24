<?php

$this->title = '更改用户: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => '用户中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';

?>

<?= $this->render( '_form', [
    'model' => $model,
    'result' => $result,
] ) ?>
