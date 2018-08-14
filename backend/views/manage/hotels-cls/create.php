<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\HotelsClassify */

$this->title = 'Create Hotels Classify';
$this->params['breadcrumbs'][] = ['label' => 'Hotels Classifies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotels-classify-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
