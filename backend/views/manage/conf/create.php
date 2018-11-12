<?php

/* @var $this yii\web\View */
/* @var $model common\models\Conf */

$this->title = '添加网站配置';
$this->params['breadcrumbs'][] = ['label' => '配置中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>

