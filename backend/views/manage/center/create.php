<?php

/* @var $this yii\web\View */
/* @var $model common\models\Conf */

$this->title = '添加网站配置';
$this->params['breadcrumbs'][] = ['label' => '网站配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
    'type'  => $type,
]) ?>

