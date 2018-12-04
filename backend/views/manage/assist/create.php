<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Assist */

$this->title = '添加网站配置';
$this->params['breadcrumbs'][] = [ 'label' => '网站配置', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>

