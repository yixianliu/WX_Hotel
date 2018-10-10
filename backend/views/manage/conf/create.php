<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Conf */

$this->title = 'Create Conf';
$this->params['breadcrumbs'][] = ['label' => 'Confs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conf-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
