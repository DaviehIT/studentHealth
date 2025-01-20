<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var dashboard\models\Appointments $model */

$this->title = 'Update Appointments: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Appointments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="appointments-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
