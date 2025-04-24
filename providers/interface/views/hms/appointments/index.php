<?php

use dashboard\models\Appointments;
use helpers\Html;
use yii\helpers\Url;
use helpers\grid\GridView;

/** @var yii\web\View $this */
/** @var dashboard\models\searches\AppointmentsSearches $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Appointments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appointments-index row">
    <div class="col-md-12">
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title"><?= Html::encode($this->title) ?> </h3>
          <div class="block-options">
            <?=Html::a('Download PDF Report', ['appointments/download-report'], ['class' => 'btn btn-danger']) ?>
          <?=  Html::customButton([
            'type' => 'modal',
            'url' => Url::to(['create']),
            'appearence' => [
              'type' => 'text',
              'text' => 'Create Appointments',
              'theme' => 'primary',
              'visible' => Yii::$app->user->can('dashboard-appointments-create', true)
            ],
            'modal' => ['title' => 'New Appointments']
          ]) ?>
          </div> 
        </div>
        <div class="block-content">     
    <div class="appointments-search my-3">
    <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          
            [
              'attribute' => 'patient_id',
              'value' => function($model) {
                  return  ($model->patient ? $model->patient->first_name .' '. $model->patient->last_name : 'No patient found');
              },
              'label' => 'Patient Info'
          ],
          [
              'attribute' => 'staff_id',
              'value' => function($model) {
                  return ($model->staff ? 'DR. '.$model->staff->first_name .' '.$model->staff->last_name : 'No staff found');
              },
              'label' => 'Doctor Info'
          ],
            'appointment_date',
            'appointment_time',
            [
              'attribute' => 'status_id',
              'value' => function($model) {
                  return  ($model->status ? $model->status->name : 'No status found');
              },
              'label' => 'Status'],
            //'remarks:ntext',
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
                        return Html::customButton(['type' => 'modal', 'url' => Url::toRoute(['update', 'id' => $model->id]), 'modal' => ['title' => 'Update  Appointments'], 'appearence' => ['icon' => 'edit', 'theme' => 'info']]);
                    },
                    'trash' => function ($url, $model, $key) {
                        return $model->is_deleted !== 1 ?
                            Html::customButton(['type' => 'link', 'url' => Url::toRoute(['trash', 'id' => $model->id]),  'appearence' => ['icon' => 'trash', 'theme' => 'danger', 'data' => ['message' => 'Do you want to delete this appointments?']]]) :
                            Html::customButton(['type' => 'link', 'url' => Url::toRoute(['trash', 'id' => $model->id]),  'appearence' => ['icon' => 'undo', 'theme' => 'warning', 'data' => ['message' => 'Do you want to restore this appointments?']]]);
                    },
                ],
                'visibleButtons' => [
                    'update' => Yii::$app->user->can('dashboard-appointments-update',true),
                    'trash' => function ($model){
                         return $model->is_deleted !== 1 ? 
                                Yii::$app->user->can('dashboard-appointments-delete',true) : 
                                Yii::$app->user->can('dashboard-appointments-restore',true);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
</div>
      </div>
    </div>