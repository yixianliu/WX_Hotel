<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Conf */

$this->title = 'Update Conf: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Confs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="conf-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
