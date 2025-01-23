<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var dashboard\models\MedicalRecords $model */

$this->title = 'Update Medical Records: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Medical Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="medical-records-update">

   


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
