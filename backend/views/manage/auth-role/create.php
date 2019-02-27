<?php

$this->title = '添加认证角色';
$this->params['breadcrumbs'][] = ['label' => '认证角色管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>
