<?php

/* @var $this yii\web\View */
/* @var $model common\models\ArticleCls */

$this->title = '更新文章分类: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '文章分类管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render( '_form', [
    'model'  => $model,
    'result' => $result,
] ) ?>

