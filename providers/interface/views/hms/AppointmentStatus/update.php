<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var dashboard\models\AppointmentStatus $model */

$this->title = 'Update Appointment Status: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Appointment Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="appointment-status-update">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
