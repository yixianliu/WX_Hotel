<?php

$this->title = '添加文章';
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render( '_form', [
    'model'  => $model,
    'result' => $result,
] ) ?>

