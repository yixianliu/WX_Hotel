<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RoomsAppointment */

$this->title = 'Update Rooms Appointment: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rooms Appointments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rooms-appointment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
