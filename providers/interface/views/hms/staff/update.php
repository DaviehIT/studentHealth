<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var dashboard\models\Staff $model */

$this->title = 'Update Staff: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="staff-update">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
