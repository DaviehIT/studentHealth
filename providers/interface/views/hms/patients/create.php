<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var dashboard\models\Patients $model */

$this->title = 'Create Patients';
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patients-create">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
