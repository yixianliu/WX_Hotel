<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RoomsAppointment */

$this->title = 'Create Rooms Appointment';
$this->params['breadcrumbs'][] = ['label' => 'Rooms Appointments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-appointment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
