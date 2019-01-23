<?php

$this->title = '添加角色';
$this->params['breadcrumbs'][] = ['label' => '角色管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render( '_form', [
    'model'  => $model,
    'result' => $result,
] ) ?>

