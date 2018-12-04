<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Assist */

$this->title = '更新网站配置: ' . $model->description;
$this->params['breadcrumbs'][] = [ 'label' => '网站配置', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = [ 'label' => $model->description, 'url' => [ 'view', 'id' => $model->id ] ];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>

