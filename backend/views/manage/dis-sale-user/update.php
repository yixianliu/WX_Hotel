<?php

$this->title = 'Update Dis Sale User: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '分销用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>

