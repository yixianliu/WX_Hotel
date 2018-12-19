<?php

/* @var $this yii\web\View */
/* @var $model common\models\ArticleCls */

$this->title = '添加文章分类';
$this->params['breadcrumbs'][] = ['label' => '文章分类管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render( '_form', [
    'model'  => $model,
    'result' => $result,
] ) ?>

