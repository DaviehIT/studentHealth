<?php

use helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/** @var yii\web\View $this */
/** @var dashboard\models\PharmacyInventory $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pharmacy Inventories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pharmacy-inventory-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'medicine_name',
            'batch_number',
            'quantity',
            'expiry_date',
            'unit_price',
            'manufacturer',
            'is_deleted',
            'created_at',
            'updated_at',
        ],
    ]) ?>
    <p>

        <?= Html::customButton(['type' => 'link', 'url' => Url::toRoute(['update', 'id' => $model->id]), 'modal' => ['title' => 'Update '], 'appearence' => ['type'=>'text','text'=>'update','theme' => 'info']]); ?>
        <?= Html::a('Delete', ['trash', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
