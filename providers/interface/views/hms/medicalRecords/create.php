<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var dashboard\models\MedicalRecords $model */

$this->title = 'Create Medical Records';
$this->params['breadcrumbs'][] = ['label' => 'Medical Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medical-records-create">

  


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
