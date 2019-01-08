<?php

$this->title = 'Create Dis Sale User';
$this->params['breadcrumbs'][] = ['label' => '分销用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>

