<?php
use yii\helpers\Html;
/** @var $inventoryItems \dashboard\models\PharmacyInventory[] */

// Ensure $inventoryItems is initialized properly
if (!is_array($inventoryItems)) {
    $inventoryItems = [];
}
?>

<h1>Pharmacy Inventory Report</h1>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Medicine Name</th>
            <th>Batch Number</th>
            <th>Quantity</th>
            <th>Expiry Date</th>
            <th>Unit Price</th>
            <th>Manufacturer</th>
        </tr>
            <td><?= isset($item->batch_number) ? Html::encode($item->batch_number) : 'N/A' ?></td>
    <tbody>
        <?php foreach ($inventoryItems as $item): ?>
        <tr>
            <td><?= Html::encode( $item->medicine_name) ?></td>
            <td><?=  Html::encode($item->batch_number) ?></td>
            <td><?=  Html::encode($item->quantity) ?></td>
            <td><?=  Html::encode($item->expiry_date) ?></td>
            <td><?=  Html::encode($item->unit_price) ?></td>
            <td><?=  Html::encode($item->manufacturer) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
