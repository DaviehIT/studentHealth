<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var dashboard\models\PharmacyInventory $model */

$this->title = 'Update Pharmacy Inventory: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pharmacy Inventories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pharmacy-inventory-update">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
