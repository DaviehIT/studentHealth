<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var dashboard\models\AppointmentStatus $model */

$this->title = 'Create Appointment Status';
$this->params['breadcrumbs'][] = ['label' => 'Appointment Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appointment-status-create">

 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
