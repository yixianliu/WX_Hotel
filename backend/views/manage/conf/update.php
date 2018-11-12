<?php

/* @var $this yii\web\View */
/* @var $model common\models\Conf */

$this->title = '更新网站配置: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '配置中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>
