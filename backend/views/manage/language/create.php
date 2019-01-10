<?php

$this->title = '添加语言类别';
$this->params['breadcrumbs'][] = ['label' => '语言管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>
