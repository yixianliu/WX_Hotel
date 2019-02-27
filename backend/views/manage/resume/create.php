<?php

$this->title = '发布简历';
$this->params['breadcrumbs'][] = ['label' => '简历管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>

