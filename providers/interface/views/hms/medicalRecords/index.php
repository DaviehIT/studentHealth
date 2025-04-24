<?php

use dashboard\models\MedicalRecords;
use helpers\Html;
use yii\helpers\Url;
use helpers\grid\GridView;

/** @var yii\web\View $this */
/** @var dashboard\models\searches\MedicalRecordsSearches $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Medical Records';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medical-records-index row">
    <div class="col-md-12">
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title"><?= Html::encode($this->title) ?> </h3>
          <div class="block-options">
            <?=Html::a('Download PDF Report', ['medical-records/download-report'], ['class' => 'btn btn-danger']) ?>
          <?=  Html::customButton([
            'type' => 'modal',
            'url' => Url::to(['create']),
            'appearence' => [
              'type' => 'text',
              'text' => 'Add Medical Records',
              'theme' => 'primary',
              'visible' => Yii::$app->user->can('dashboard-medical-records-create', true)
            ],
            'modal' => ['title' => 'New Medical Records']
          ]) ?>
          </div> 
        </div>
        <div class="block-content">     
    <div class="medical-records-search my-3">
    <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           [
            'attribute'=> 'patient_id',
             'value' => function($model) {
                 return  ($model->patient ? $model->patient->first_name .' '. $model->patient->last_name : 'No patient found');
             },
             'label' => 'Patient Info'
           ],
           [
            'attribute'=> 'staff_id',
             'value' => function($model) {
                 return  ($model->staff ? $model->staff->first_name .' '. $model->staff->last_name : 'No staff found');
             },
              'label' => 'Doctor Info'
           ],
          
           
            'diagnosis:ntext',
            'treatment:ntext',
            //'prescription:ntext',
            //'is_deleted',
            //'created_at',
            //'updated_at',
            [
                'class' => \helpers\grid\ActionColumn::className(),
                'template' => '{update} {trash}',
                'headerOptions' => ['width' => '8%'],
                'contentOptions' => ['style'=>'text-align: center;'],
                 'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::customButton(['type' => 'modal', 'url' => Url::toRoute(['update', 'id' => $model->id]), 'modal' => ['title' => 'Update  Medical Records'], 'appearence' => ['icon' => 'edit', 'theme' => 'info']]);
                    },
                    'trash' => function ($url, $model, $key) {
                        return $model->is_deleted !== 1 ?
                            Html::customButton(['type' => 'link', 'url' => Url::toRoute(['trash', 'id' => $model->id]),  'appearence' => ['icon' => 'trash', 'theme' => 'danger', 'data' => ['message' => 'Do you want to delete this medical records?']]]) :
                            Html::customButton(['type' => 'link', 'url' => Url::toRoute(['trash', 'id' => $model->id]),  'appearence' => ['icon' => 'undo', 'theme' => 'warning', 'data' => ['message' => 'Do you want to restore this medical records?']]]);
                    },
                ],
                'visibleButtons' => [
                    'update' => Yii::$app->user->can('dashboard-medical-records-update',true),
                    'trash' => function ($model){
                         return $model->is_deleted !== 1 ? 
                                Yii::$app->user->can('dashboard-medical-records-delete',true) : 
                                Yii::$app->user->can('dashboard-medical-records-restore',true);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
</div>
      </div>
    </div>