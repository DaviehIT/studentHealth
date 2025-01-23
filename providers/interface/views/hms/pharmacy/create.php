<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var dashboard\models\PharmacyInventory $model */

$this->title = 'Create Pharmacy Inventory';
$this->params['breadcrumbs'][] = ['label' => 'Pharmacy Inventories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pharmacy-inventory-create">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
