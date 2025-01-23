<?php

use dashboard\models\PharmacyInventory;
use helpers\Html;
use yii\helpers\Url;
use helpers\grid\GridView;

/** @var yii\web\View $this */
/** @var dashboard\models\searches\PharmacyInventorySearches $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pharmacy Inventories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pharmacy-inventory-index row">
    <div class="col-md-12">
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title"><?= Html::encode($this->title) ?> </h3>
          <div class="block-options">
          <?=  Html::customButton([
            'type' => 'modal',
            'url' => Url::to(['create']),
            'appearence' => [
              'type' => 'text',
              'text' => 'Add Product',
              'theme' => 'primary',
              'visible' => Yii::$app->user->can('dashboard-pharmacy-create', true)
            ],
            'modal' => ['title' => 'New Pharmacy Inventory']
          ]) ?>
          </div> 
        </div>
        <div class="block-content">     
    <div class="pharmacy-inventory-search my-3">
    <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            'medicine_name',
            'batch_number',
            'quantity',
            'expiry_date',
            'unit_price',
            'manufacturer',
            //'is_deleted',
            //'created_at',
            //'updated_at',
            [
                'class' => \helpers\grid\ActionColumn::class,
                'template' => '{update} {trash} {view}',
                'headerOptions' => ['width' => '18%'],
                'contentOptions' => ['style'=>'text-align: center;'],
                 'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::customButton(['type' => 'modal', 'url' => Url::toRoute(['update', 'id' => $model->id]), 'modal' => ['title' => 'Update  Pharmacy Inventory'], 'appearence' => ['icon' => 'edit', 'theme' => 'info']]);
                    },
                    'trash' => function ($url, $model, $key) {
                        return $model->is_deleted !== 1 ?
                            Html::customButton(['type' => 'link', 'url' => Url::toRoute(['trash', 'id' => $model->id]),  'appearence' => ['icon' => 'trash', 'theme' => 'danger', 'data' => ['message' => 'Do you want to delete this pharmacy inventory?']]]) :
                            Html::customButton(['type' => 'link', 'url' => Url::toRoute(['trash', 'id' => $model->id]),  'appearence' => ['icon' => 'undo', 'theme' => 'warning', 'data' => ['message' => 'Do you want to restore this pharmacy inventory?']]]);
                    },
                    'view' => function ($url, $model, $key) {
                        return Html::customButton(['type' => 'modal', 'url' => Url::toRoute(['view', 'id' => $model->id]), 'modal' => ['title' => 'View  Pharmacy Inventory'], 'appearence' => ['icon' => 'eye', 'theme' => 'info']]);
                    },
                ],
                'visibleButtons' => [

                    'update' => Yii::$app->user->can('dashboard-pharmacy-update',true),
                    'trash' => function ($model){
                         return $model->is_deleted !== 1 ? 
                                Yii::$app->user->can('dashboard-pharmacy-delete',true) : 
                                Yii::$app->user->can('dashboard-pharmacy-restore',true);
                    },
                    'view' => Yii::$app->user->can('dashboard-pharmacy-view',true),
                ],
            ],
        ],
    ]); ?>


</div>
</div>
      </div>
    </div>