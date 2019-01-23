<?php

$this->title = '添加用户';
$this->params['breadcrumbs'][] = ['label' => '用户中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render( '_form', [
    'model'  => $model,
    'result' => $result,
] ) ?>
